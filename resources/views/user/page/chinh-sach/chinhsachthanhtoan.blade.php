@extends('user.master')
@section('content')


<section class="bread-crumb clearfix">
    <span class="crumb-border"></span>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 a-left">
                <ul class="breadcrumb">					
                    <li class="home">
                        <a itemprop="url" href="trangchu" ><span >Trang chủ</span></a>						
                        <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>
                    </li>
                    
                    <li >
                        <a itemprop="url" href="gioithieu"><span >Chính sách thanh toán</span></a>	
                        <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>
                    </li>

                    <div class="static-contain">
                        <h1 style="text-align: center;"><strong>CHÍNH SÁCH THANH TOÁN</strong></h1>
                        <p><span style="font-size:18px;"><span style="font-family:Arial,Helvetica,sans-serif;">Có 2 hình thức thanh toán, khách hàng có thể lựa chọn hình thức thuận tiện và phù hợp với mình nhất:</span></span></p>
                        <p><span style="font-size:18px;"><span style="font-family:Arial,Helvetica,sans-serif;"><strong>Cách 1: </strong>Thanh toán tiền mặt trực tiếp tại đại lý&nbsp;PVT Store tại địa chỉ sau:</span></span></p>
                        <p style="margin-left: 40px;"><span style="font-size:16px;"><span style="font-family:Arial,Helvetica,sans-serif;">Số 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội</span></span></p>
                        <p><span style="font-size:18px;"><span style="font-family:Arial,Helvetica,sans-serif;"><strong>Cách 2:</strong> Thanh toán khi nhận hàng (COD), khách hàng xem hàng tại nhà, thanh toán tiền mặt cho nhân viên giao nhận hàng. Hoặc thanh toán trực tuyến trên website cửa hàng qua VNPAY</span></span></p>
                        <img class="img-responsive" width="1140px" src="{{asset('assetsUser/images/s1.jpg')}}">
				    </div>
                </ul>
            </div>
        </div>
    </div>
</section>
</body>
</html>
@endsection	