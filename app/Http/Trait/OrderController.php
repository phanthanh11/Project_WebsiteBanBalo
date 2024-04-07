<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DetailOrder;
use App\Models\KhachHang;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Ticket;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function pay()
    {
        return view('frontend.pages.pay');
    }
    public function paysuccess()
    {
        return view('frontend.pages.pay_success');
    }
    public function create(Request $request)
    {
        $customer = new KhachHang();
        $customer->name = $request->input('name');
        $customer->phoneNumber = $request->input('phoneNumber');
        $customer->email = $request->input('email');
        $customer->ticketDate = $request->input('ticketDate');
        $customer->status = 0;
        $customer->save();
        $package = $request->input('package');
        $ticket = Ticket::where('ID_PACK', $package)->first();

        $goi = Package::where('ID_PACK', $package)->first();
        $tengoi = $goi->name;
        $order = new Order();
        $order->ID_CU = $customer->ID_CU;
        $order->ID_TICKET = $ticket->ID_TICKET;
        $order->quantity = $request->input('quantity');
        $order->status = 0;
        $order->save();
        $tongtien = ($ticket->price) * ($order->quantity);
        $detailOrder = new DetailOrder();
        $detailOrder->ID_ORDER = $order->ID_ORDER;
        $detailOrder->price = $tongtien;
        $detailOrder->save();
        $settings = Setting::find(1);
        return view('frontend.pages.pay')->with([
            'customer' => [
                'name' => $customer->name,
                'phoneNumber' => $customer->phoneNumber,
                'email' => $customer->email,
                'ticketDate' => $customer->ticketDate,
            ],
            'order' => [
                'ID_CU' => $order->ID_CU,
                'ID_TICKET' => $order->ID_TICKET,
                'quantity' => $order->quantity,
            ],
            'detailOrder' => [
                'ID_ORDER' => $detailOrder->ID_ORDER,
                'price' => $detailOrder->price,
            ],

        ])->with('tengoi', $tengoi)->with('settings', $settings);
    }
    public function checkout(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_TmnCode = "W5KCFHGJ";
        $vnp_HashSecret = "VFVOAUJQDXJYBCGRSLQXJSULUMPJPQTZ";
        $customer = $request->input('ID_CU');
        $ticket = $request->input('ID_TICKET');
        $price = $request->input('price');
        $quantity = $request->input('quantity');
        $vnp_Returnurl = route('callback', ['ID_CU' => $customer, 'ID_TICKET' => $ticket, 'quantity' => $quantity]);
        $vnp_TxnRef = uniqid();
        $vnp_OrderInfo = "Thanh toán Vé Đầm Sen Datgold";
        $vnp_OrderType = "Vé little & LITTLE";
        $vnp_Amount = $price * 100000;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $request->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );
        return redirect()->to($vnp_Url);
    }
    public function callback(Request $request, $ID_CU, $ID_TICKET, $quantity)
    {
        $responseData = $request->all();
        $payment = Payment::create($responseData);
        $mave = $payment->vnp_BankTranNo;
        $customer = Customer::find($ID_CU);
        $customer->status = 1;
        $customer->save();

        $ticket = Ticket::find($ID_TICKET);
        $ticket->quantity -= $quantity;
        $ticket->save();

        $order = Order::where('ID_CU', $ID_CU)->first();
        $order->status = 1;
        $order->save();
        $name = $customer->name;
        $ticketDate = $customer->ticketDate;
        $soluong = $order->sum('quantity');
        $price = $ticket->price;

        $qrCodes = [];
        for ($i = 0; $i < $quantity; $i++) {
            $qrCodeData = [
                'name' => $name,
                'soluong' => $soluong,
                'price' => $price,
                'ticketDate' => $ticketDate,
            ];

            $qrCodeSvg = QrCode::format('svg')->generate(json_encode($qrCodeData));

            $qrCodes[] = [
                'name' => $name,
                'soluong' => $soluong,
                'ticketDate' => $ticketDate,
                'price' => $price,
                'qrCodeSvg' => $qrCodeSvg,
            ];
        }
        $settings = Setting::find(1);
        return view('frontend.pages.pay_success', compact('qrCodes'))->with('mave', $mave)->with('settings', $settings);
    }
}