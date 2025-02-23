<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private $viewFolder = 'dashboard';
    private $page = 'dashboard';

    public function index() {
        $pageInfo = [
            'page'  => $this->page
        ];
        
        return view("admin.{$this->viewFolder}", compact('pageInfo'));
    }

    public function getOrderToDay()
    {
        $pageInfo = [
            'page'  => $this->page
        ];
        $order=HoaDon::whereDay('ngay_dat',date('d'))->get();
        return view('admin.Hoa-don.order-search',compact('order','pageInfo'));
    }

    public function getOrderOnWeek()
    {
        $pageInfo=[
            'page'=>$this->page
        ];
        $mondayLast = Carbon::now()->startOfWeek();
        //dd($mondayLast);
		$sundayFirst = Carbon::now()->endOfWeek();
        $order=HoaDon::whereBetween('ngay_dat',[$mondayLast,$sundayFirst])->get();
        return view('admin.Hoa-don.order-search',compact('order','pageInfo'));
    }
    public function getTotalProfit()
{
    $pageInfo = [
        'page' => $this->page
    ];

    // Sử dụng join để kết nối bảng HoaDon, ChiTietHoaDon và Product
    $totalProfit = HoaDon::join('chi_tiet_hoa_don', 'hoa_don.id', '=', 'chi_tiet_hoa_don.hoa_don_id')
        ->join('chi_tiet_san_pham', 'chi_tiet_hoa_don.san_pham_id', '=', 'chi_tiet_san_pham.san_pham_id')
        ->sum(\DB::raw('((so_luong * gia_ban) - (so_luong * san_pham.gia_nhap)) - (so_luong * san_pham.giam_gia)'));

    return view('admin.Hoa-don.order-search', compact('totalProfit', 'pageInfo'));
}

}
