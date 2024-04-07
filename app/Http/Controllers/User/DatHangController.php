<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Trait\VNPayTrait;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\ChiTietSP;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;

class DatHangController extends Controller
{
    use VNPayTrait;

    public function index()
    {
        if (Session::get('cart') == null) {
            alert()->error('Lỗi!', 'Hãy thêm sản phẩm vào giỏ hàng trước!');
            return redirect()->route('trangchu');
        } else {
            return view('user.page.dat-hang.dathang');
        }
    }

    public function datHang(Request $req)
    {
        // Code xử lý thanh toán vnpay đây, bạn tự đánh giá xem đặt  đâu cho hợp lý.
        // Có thể bỏ commnet chỗ dd ra để thông tin chi tiết hơn
        // Muốn lấy data động thì chuyền vào hàm  createPayment xong xử lý bình thường
        if ($req->paymentMethod == "VNP") {
            $giohang = Session::get('cart');
            $tongtien = $giohang->tongTien;
            $hoten = $req->input('hoten');
            $sdt = $req->input('sdt');
            $gioitinh = $req->input('gioitinh');
            $diachi = $req->input('diachi');
            $ghichu = $req->input('ghichu');

            //Đặt hàng khi đã đăng nhập
            if (Auth::check()) {
                $hoadon = new HoaDon;
                $mahd = now();
                $maDH = 'HD' . $mahd . '';
                $khachhangID = Auth::user()->id;
                $ngaydat = now();
                $tongtien = $giohang->tongTien;
                $diachinhan = $req->diachi;
                $hinhthucthanhtoan = $req->paymentMethod;
                $ghichu = $req->ghichu;
                $webViewVNPay = $this->createPayment($maDH, $khachhangID, $ngaydat, $tongtien, $diachinhan, $hinhthucthanhtoan);
                // dd($webViewVNPay);
                return redirect()->to($webViewVNPay);

                $hoadon->ma_hd = 'HD' . $mahd . '';
                $hoadon->khach_hang_id = Auth::user()->id;
                $hoadon->ngay_dat = now();
                $hoadon->tong_tien = $giohang->tongTien;
                $hoadon->dia_chi_nhan = $req->diachi;
                $hoadon->hinh_thuc_thanh_toan = $req->paymentMethod;
                $hoadon->ghi_chu = $req->ghichu;
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

                $now = date('Y-m-d');
                $title_email = "Đơn hàng xác nhận ngày" . ' ' . $now;
                if (Auth::check()) {
                    $khachhang = User::find(Auth::user()->id);
                }
                $emailKH = $khachhang->email;

                if (Session::get('cart') == true) {
                    foreach ($giohang->items as $key => $value) {
                        $cart_array[] = array(
                            'ten_sp' => $value['item']['ten_sp'],
                            'gia' => $value['gia'],
                            'so_luong' => $value['so_luong']
                        );
                    }
                }

                $shipping_array = array(
                    'id'            => $hoadon->id,
                    'ten'           => $req->hoten,
                    'email'         => $req->$emailKH,
                    'sdt'           => $req->sdt,
                    'dia_chi'       => $req->diachi,
                    'paymentMethod' => $req->paymentMethod,
                    'ghi_chu'       => $req->ghichu
                );

                // Mail::send(
                //     'user.page.mail.mail-order',
                //     ['cart_array' => $cart_array, 'shipping_array' => $shipping_array],
                //     function ($message) use ($title_email, $emailKH) {
                //         $message->to($emailKH)->subject($title_email);
                //         $message->from($emailKH, $title_email);
                //     }
                // );
                Session::forget('cart');
                return redirect()->route('trangchu');
            } else {

                $User = new User;
                $User->vai_tro_id = 1;
                $User->email = $req->email;
                $User->ten = $req->hoten;
                $User->sdt = $req->sdt;
                $User->gioi_tinh = $req->gioitinh;
                $User->save();

                $hoadon = new HoaDon;
                $mahd = now();
                $maDH = 'HD' . $mahd . '';
                $khachhangID = $User->id;
                $ngaydat = now();
                $tongtien = $giohang->tongTien;
                $diachinhan = $req->diachi;
                $hinhthucthanhtoan = $req->paymentMethod;
                $ghichu = $req->ghichu;
                $webViewVNPay = $this->createPayment($maDH, $khachhangID, $ngaydat, $tongtien, $diachinhan, $hinhthucthanhtoan);
                // dd($webViewVNPay);
                return redirect()->to($webViewVNPay);
                $hoadon->ma_hd = 'HD' . $mahd . '';
                $hoadon->khach_hang_id = $User->id;
                $hoadon->ngay_dat = now();
                $hoadon->tong_tien = $giohang->tongTien;
                $hoadon->dia_chi_nhan = $req->diachi;
                $hoadon->hinh_thuc_thanh_toan = $req->paymentMethod;
                $hoadon->ghi_chu = $req->ghichu;
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
            }
        } else {
            $giohang = Session::get('cart');
            $tongtien = $giohang->tongTien;
            //Đặt hàng khi đã đăng nhập
            if (Auth::check()) {
                $hoadon = new HoaDon;
                $mahd = now();
                $maDH = 'HD' . $mahd . '';
                $khachhangID = Auth::user()->id;
                $ngaydat = now();
                $tongtien = $giohang->tongTien;
                $diachinhan = $req->diachi;
                $hinhthucthanhtoan = $req->paymentMethod;
                $ghichu = $req->ghichu;

                $hoadon->ma_hd = 'HD' . $mahd . '';
                $hoadon->khach_hang_id = Auth::user()->id;
                $hoadon->ngay_dat = now();
                $hoadon->tong_tien = $giohang->tongTien;
                $hoadon->dia_chi_nhan = $req->diachi;
                $hoadon->hinh_thuc_thanh_toan = $req->paymentMethod;
                $hoadon->ghi_chu = $req->ghichu;
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

                $now = date('Y-m-d');
                $title_email = "Đơn hàng xác nhận ngày" . ' ' . $now;
                if (Auth::check()) {
                    $khachhang = User::find(Auth::user()->id);
                }
                $emailKH = $khachhang->email;

                if (Session::get('cart') == true) {
                    foreach ($giohang->items as $key => $value) {
                        $cart_array[] = array(
                            'ten_sp' => $value['item']['ten_sp'],
                            'gia' => $value['gia'],
                            'so_luong' => $value['so_luong']
                        );
                    }
                }

                $shipping_array = array(
                    'id'            => $hoadon->id,
                    'ten'           => $req->hoten,
                    'email'         => $req->$emailKH,
                    'sdt'           => $req->sdt,
                    'dia_chi'       => $req->diachi,
                    'paymentMethod' => $req->paymentMethod,
                    'ghi_chu'       => $req->ghichu
                );

                // Mail::send(
                //     'user.page.mail.mail-order',
                //     ['cart_array' => $cart_array, 'shipping_array' => $shipping_array],
                //     function ($message) use ($title_email, $emailKH) {
                //         $message->to($emailKH)->subject($title_email);
                //         $message->from($emailKH, $title_email);
                //     }
                // );
                Session::forget('cart');
                alert()->success('Đặt hàng thành công!', 'Cảm ơn quý khách đã mua sản phẩm của chúng tôi ♥');
                return redirect()->route('trangchu');
            } else {

                $User = new User;
                $User->vai_tro_id = 1;
                $User->ten = $req->hoten;
                $User->sdt = $req->sdt;
                $User->gioi_tinh = $req->gioitinh;
                $User->save();

                $hoadon = new HoaDon;
                $mahd = now();
                $maDH = 'HD' . $mahd . '';
                $khachhangID = $User->id;
                $ngaydat = now();
                $tongtien = $giohang->tongTien;
                $diachinhan = $req->diachi;
                $hinhthucthanhtoan = $req->paymentMethod;
                $hoadon->ma_hd = 'HD' . $mahd . '';
                $hoadon->khach_hang_id = $User->id;
                $hoadon->ngay_dat = now();
                $hoadon->tong_tien = $giohang->tongTien;
                $hoadon->dia_chi_nhan = $req->diachi;
                $hoadon->hinh_thuc_thanh_toan = $req->paymentMethod;
                $hoadon->ghi_chu = $req->ghichu;
                $hoadon->tinh_trang = 'Đang duyệt';
                $hoadon->save();
                foreach ($giohang->items as $key => $value) {
                    //Update số lượng khi đặt hàng
                    $updateSL = ChiTietSP::find($key);
                    $updateSL->so_luong -= $value['so_luong'];
                    // $updateSL->save();

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
    }

    public function datHangThanhCong(Request $req, $maDH, $khachhangID, $ngaydat, $tongtien, $diachinhan, $hinhthucthanhtoan)
    {
        // Thông tin đơn hàng trả về ở đây
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
