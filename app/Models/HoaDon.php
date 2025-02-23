<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class HoaDon extends Model
{
    use Sortable;
    protected $table = "hoa_don";
    protected $fillable = [
        'ma_hd',
        'khach_hang_id',
        'tong_tien',
        'ngay_dat',
        'dia_chi_nhan',
        'hinh_thuc_thanh_toan',
        'ghi_chu',
        'tinh_trang'
    ];
    public function chitiethoadon()
    {
        return $this->hasMany(ChiTietHoaDon::class, 'hoa_don_id', 'id');
    }

    public function khachdathang()
    {
        return $this->belongsTo(KhachHang::class, 'khach_hang_id', 'id');
    }


    public function scopeGetProductByDate($query, $req)
    {
        if (empty($req->toDate) && !empty($req->fromDate)) {
            $from = date('Y-m-d', strtotime($req->fromDate));
            $query->whereDate('created_at', '>=', $from);
        }

        if (empty($req->fromDate) && !empty($req->toDate)) {
            $to = date('Y-m-d', strtotime($req->toDate));
            $query->whereDate('created_at', '<=', $to);
        }

        if (!empty($req->fromDate) && !empty($req->toDate)) {
            $from = date('Y-m-d', strtotime($req->fromDate));
            $to = date('Y-m-d', strtotime($req->toDate));
            $query->whereDate('created_at', '>=', $from)
                ->whereDate('created_at', '<=', $to);
        }

        return $query->select("*")->orderBy('ma_hd');
    }

    public static function countOrderTime()
    {
        $today = Carbon::today();
        $data = HoaDon::whereDay('ngay_dat', date('d'))->count();
        //dd($data);
        if ($data) {
            return $data;
        }
        return 0;
    }

    public static function countOrderWeek()
    {
        $mondayLast = Carbon::now()->startOfWeek();
        //dd($mondayLast);
        $sundayFirst = Carbon::now()->endOfWeek();
        //dd($sundayFirst);
        $totalOrder = HoaDon::whereBetween('ngay_dat', [$mondayLast, $sundayFirst])->count();
        if ($totalOrder) {
            return $totalOrder;
        }
        return 0;
    }
    //Tính Lợi Nhuận trong tuần 
    public function getTotalProfit()
    {
        // Sử dụng join để kết nối bảng HoaDon, ChiTietHoaDon và Product
        $totalProfit = HoaDon::join('chi_tiet_hoa_don', 'hoa_don.id', '=', 'chi_tiet_hoa_don.hoa_don_id')
            ->join('chi_tiet_sp', 'chi_tiet_hoa_don.san_pham_id', '=', 'chi_tiet_sp.san_pham_id')
            ->whereBetween('hoa_don.ngay_dat', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum(\DB::raw('((chi_tiet_hoa_don.so_luong * chi_tiet_sp.gia) - (chi_tiet_hoa_don.so_luong * chi_tiet_sp.gianhap)) - (chi_tiet_hoa_don.so_luong * chi_tiet_sp.giam_gia)'));
        return $totalProfit;
    }
    //Tính Doanh Thu Trong Tuần 
    public function getTotalDT()
    {
        // Sử dụng join để kết nối bảng HoaDon và ChiTietHoaDon
        $totalRevenue = HoaDon::join('chi_tiet_hoa_don', 'hoa_don.id', '=', 'chi_tiet_hoa_don.hoa_don_id')
            ->whereBetween('hoa_don.ngay_dat', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum(\DB::raw('chi_tiet_hoa_don.so_luong * chi_tiet_hoa_don.don_gia'));

        return $totalRevenue;
    }
}
