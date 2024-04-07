@extends('user.master')
@section('content')


<section class="bread-crumb clearfix">
    <span class="crumb-border"></span>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 a-left">
                <ul class="breadcrumb">
                    <li class="home">
                        <a itemprop="url" href="trangchu"><span>Trang chủ</span></a>
                        <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>
                    </li>

                    <li>
                        <a itemprop="url" href="lienhe"><span>Thông Tin Liên Hệ</span></a>
                        <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>
                    </li>

                    <li>
                        <h2 style="color: #000000;text-align: left" class="vc_custom_heading">LIÊN HỆ VỚI <p></p>
                        </h2>
                    </li>

                    <li class="col-lg-6">


                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous" src="#" nonce="UfF4nwNS"></script>
                        <div style="margin-left: 650px;" class="fb-page" data-href="#" data-tabs="timeline" data-width="500" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/tuyenphung0912" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/tuyenphung0912/">Shop </a></blockquote>
                        </div>


                        <ul>
                            <li>
                                <a href="trangchu" class="logo-wrapper ">
                                    <img src="{{ asset('images/logo-2.png') }}" alt="logo ">
                                </a><br><br>
                            </li>
                            <li>
                                <span class="fa fa-home"></span> <span class="frist_"><span class="b_font"></span>1173/13B tỉnh lộ 43 bình chiểu thủ đức</span><br><br>
                            </li>

                            <li>
                                <span class="fa fa-phone"></span><span class="frist_"><span class="b_font"><a href="tel:0388333421"> 0388333421</a></span></span><br><br>
                            </li>

                            <li>
                                <span class="fa fa-paper-plane"></span><span class="frist_"><span class="b_font"><a href="mailto:thanhpqbs00069@fpt.edu.vn">thanhpqbs00069@fpt.edu.vn</a> </span><br></span><br>
                            <li>

                            <li>
                                <div class="social_right">
                                    <a href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </div>
                            <li>
                        </ul>
                    </li>

                    <li class="col-lg-6">
                        <!-- Map -->
                        <div class="wpb_gmaps_widget wpb_content_element">
                            <div class="wpb_wrapper">
                                <div class="wpb_map_wraper">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6308952540594!2d105.83764378619048!3d21.007427838598716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab8a922653a9%3A0x6c2ec19683313eab!2zMSDEkOG6oWkgQ-G7kyBWaeG7h3QsIELDoWNoIEtob2EsIEhhaSBCw6AgVHLGsG5nLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1705516003547!5m2!1svi!2s" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
            </div>
            <li>
                </ul>
        </div>
    </div>



    </body>

    </html>
    @endsection