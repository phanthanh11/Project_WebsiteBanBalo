<?php

namespace App\Http\Trait;

use App\Models\ChiTietHoaDon;
use App\Models\ChiTietSP;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

trait VNPayTrait
{
    public function createPayment($maDH, $khachhangID, $ngaydat, $tongtien, $diachinhan, $hinhthucthanhtoan)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_TmnCode = "T9AIVD81";
        $vnp_HashSecret = "BBMERZYSBNWDSATDUJVCKIAMZRVKSAYA";

        $vnp_TxnRef = uniqid();
        $vnp_OrderInfo = 'Noi dung thanh toan';
        $vnp_OrderType = 'topup';
        $vnp_Amount = $tongtien * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $vnp_Returnurl = route('dathangpaythanhcong', ['maDH' => $maDH, 'khachhangID' => $khachhangID, 'ngaydat' => $ngaydat, 'tongtien' => $tongtien, 'diachinhan' => $diachinhan, 'hinhthucthanhtoan' => $hinhthucthanhtoan]);
        //Billing


        $vnp_Bill_State = null;
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
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
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
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );

        return $returnData['data'];
    }
    public function dathangpaythanhcong(Request $req, $maDH, $khachhangID, $ngaydat, $tongtien, $diachinhan, $hinhthucthanhtoan)
    { // Thông tin đơn hàng trả về ở đây
        $dataRequest = $req->toArray();

        // Code xử lý thanh toán vnpay đây, bạn tự đánh giá xem đặt  đâu cho hợp lý.
        // Có thể bỏ commnet chỗ dd ra để thông tin chi tiết hơn
        // Muốn lấy data động thì chuyền vào hàm  createPayment xong xử lý bình thường
        $giohang = Session::get('cart');

        //Lấy giỏ hàng
        $giohang = Session::get('cart');


        $hoadon = new HoaDon;
        $mahd = $maDH;
        $hoadon->ma_hd = 'HD' . $mahd . '';
        $hoadon->khach_hang_id = $khachhangID;
        $hoadon->ngay_dat = $ngaydat;
        $hoadon->tong_tien = $tongtien;
        $hoadon->dia_chi_nhan = $diachinhan;
        $hoadon->hinh_thuc_thanh_toan = $hinhthucthanhtoan;
        // $hoadon->ghi_chu = $ghichu;
        $hoadon->tinh_trang = 'Đang duyệt';
        $hoadon->save();
        foreach ($giohang->items as $key => $value) {

            //Update số lượng khi đặt hàng
            $updateSL = ChiTietSP::find($key);
            $updateSL->so_luong -= $value['so_luong'];
            $updateSL->save();

            $chitiethoadon = new ChiTietHoaDon;
            $chitiethoadon->hoa_don_id = $hoadon->id;
            $chitiethoadon->san_pham_id = $key;
            $chitiethoadon->so_luong = $value['so_luong'];
            $chitiethoadon->don_gia = ($value['gia'] / $value['so_luong']);
            $chitiethoadon->thanh_tien = ($value['gia'] / $value['so_luong']) * $value['so_luong'];
            $chitiethoadon->save();
        }
        Session::forget('cart');
        alert()->success('Đặt hàng thành công!', 'Cảm ơn quý khách đã mua sản phẩm của chúng tôi ♥');
        return redirect()->route('trangchu');
    }
}
