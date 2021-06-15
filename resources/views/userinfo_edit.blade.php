<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Booking Restaurant</title>
        <!-- <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}"> -->
        <meta name="description" content="">
        <link rel="icon" href="{{ asset('img/food.webp') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style>
            @import url("https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap");
        </style>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style2.css') }}"> 
        <link rel="stylesheet" href="{{ asset('css/style3.css') }}">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
        <style>
        @import url("https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap");
        </style>
    </head>
    <body>
        <div id="loader"></div>
        <div style="display:none;" id="myDiv" class="animate-bottom"><div>
        <header>
            <a href="/restaurant/public/manage/userinfo"><button class="book-h"><div class="word">Edit User Information</div></button></a>
            <div class="link">
                <a href="/restaurant/public/manage/logout"><button type="button" class="btn btn-dark beyond2">
                    <i class="fa fa-user-circle"></i>會員登出
                </button></a> 
                <button type="button" class="btn btn-secondary">
                    <i class="fa fa-undo" aria-hidden="true"></i><a href="/restaurant/public/manage/userinfo" style="color:#fff;text-decoration:none">取消修改</a>
                </button>         
                <a href="https://www.google.com/" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Google" style="color:#fff"><i class="fa fa-google beyond" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Facebook" style="color:#fff"><i class="fa fa-facebook beyond" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Instagram" style="color:#fff"><i class="fa fa-instagram beyond" aria-hidden="true"></i></a>
                <a href="https://www.linkedin.com/" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Linkedin" style="color:#fff"><i class="fa fa-linkedin beyond" aria-hidden="true"></i></a>
                <a href="https://www.twitter.com/" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Twitter" style="color:#fff"><i class="fa fa-twitter beyond" aria-hidden="true"></i></a>
                <a href="https://www.youtube.com/" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Youtube" style="color:#fff"><i class="fa fa-youtube beyond3" aria-hidden="true"></i></a>
                <!-- <a href="https://www.pinterest.com/" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest beyond" aria-hidden="true"></i></a> -->
                <!-- <button class="navbar-toggler burger" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <!-- <label for="burger" id="touch">☰</label>
                <input type="checkbox" id="burger">
                <ul id="show" class="list-group">
                    <li class="list-group-item"><a href="/restaurant/public/index" style="text-decoration:none">首頁</a></li>
                    @if(session('account'))
                    <li class="list-group-item"><a href="##" style="text-decoration:none" data-toggle="modal" data-target="#myModal2">留言專區</a></li>
                    @endif
                    <li class="list-group-item"><a href="/restaurant/public/manage" style="text-decoration:none">進入後台</a></li>
                    <li class="list-group-item"><a href="##" style="text-decoration:none">聯絡我們</a></li>
                </ul> -->
                <div class="dropdown beyond5">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        ☰選單
                    </button>
                    <div class="dropdown-menu">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="/restaurant/public/manage/userinfo" style="text-decoration:none;font-weight:bold">會員資料</a></li>
                            <li class="list-group-item"><a href="/restaurant/public/manage/orderinfo" style="text-decoration:none;font-weight:bold">訂單資料</a></li>
                            <li class="list-group-item"><a href="/restaurant/public/manage/chatinfo" style="text-decoration:none;font-weight:bold">留言資料</a></li>
                            <li class="list-group-item"><a href="##" style="text-decoration:none;font-weight:bold">聯絡我們</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        
        <img src="{{asset('img/food.jpg')}}" class="img">
        <div class="w3-display-middle2" style="width:85%">
            <div class="row">
                <div class="column side2">
                    <div class="topnav">
                    </div>
                </div>
                
                <div class="column middle3">
                    <div class="w3-container w3-red">
                        <h2><i class="fa fa-sign-in w3-margin-right" aria-hidden="true"></i>Go to backend</h2>
                    </div>
                    <div class="w3-container3 w3-white w3-padding-16">
                        <form method="post" action="/restaurant/public/manage/userinfo_update" class="needs-validation" novalidate>
                            <div class="row">
                                @foreach($DATA as $data)
                                <div class="col-sm-6">
                                    <label for="account" class="la2"><i class="fa fa-id-card" aria-hidden="true"></i>帳號</label>
                                    <input type="text" name="account" id="account" value="{{$data->account}}" required>
                                    <div class="valid-feedback la2">Valid.</div>
                                    <div class="invalid-feedback la2">Please fill out this field.</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="pwd" class="la2"><i class="fa fa-user-o" aria-hidden="true"></i>密碼</label>
                                    <input type="text" name="pwd" id="pwd" value="{{$data->password}}" required>
                                    <div class="valid-feedback la2">Valid.</div>
                                    <div class="invalid-feedback la2">Please fill out this field.</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="name" class="la2"><i class="fa fa-address-card-o" aria-hidden="true"></i>姓名</label>
                                    <input type="text" name="name" id="name" value="{{$data->name}}" required>
                                    <div class="valid-feedback la2">Valid.</div>
                                    <div class="invalid-feedback la2">Please fill out this field.</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="mobile" class="la2"><i class="fa fa-mobile" aria-hidden="true"></i>手機號碼</label><br>
                                    <input type="tel" name="mobile" id="mobile" value="{{$data->phone}}" required>
                                    <div class="valid-feedback la2">Valid.</div>
                                    <div class="invalid-feedback la2">Please fill out this field.</div>
                                    <div id="mobile_info"></div>
                                </div>
                                <input type="hidden" name="kn" value="{{$data->kn}}">
                                @endforeach
                                <div class="col-sm-4">
                                    <button id="submit2" type="submit" style="margin-bottom:100px; margin-top:22px"><i class="fa fa-hand-pointer-o" aria-hidden="true" style="padding-right:15px"></i>修改</button>
                                </div>
                            </div>
                            {!! csrf_field() !!}
                        </form>
                    </div>
                   
                    
                    
                    <!-- <div class="calendar" id="calendar">
                        <div class="month" id="month">
                            <ul>
                                <li><h5><a href="" id="prev" style="text-decoration:none;">&#10094;</a></h5></li>
                                <li><h5><a href="" id="next" style="text-decoration:none;">&#10095;</a></h5></li>
                                <li>
                                    <h1 class="green" id="calendar-title">Month</h1>
                                    <span style="font-size:18px"><h2 id="calendar-year" class="green">Year</h2></span>
                                </li>
                            </ul>
                        </div>
                        <div class="body" id="body">
                            <div class="lightgrey body-list">
                                <ul>
                                    <li id="one">MON</li>
                                    <li id="two">TUE</li>
                                    <li id="three">WED</li>
                                    <li id="four">THU</li>
                                    <li id="five">FRI</li>
                                    <li id="six">SAT</li>
                                    <li id="seven">SUN</li>
                                </ul>
                            </div>
                            <div class="darkgrey body-list">
                                <ul id="days">
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <footer class="bg-dark text-center text-lg-start">
            <!-- Grid container -->
            <div class="container p-4">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">

                        <ul class="list-unstyled mb-0">
                            <li class="my-2">
                                <img class="img-fluid"
                                    src="{{ asset('img/chef.jpg') }}"
                                    style="width:80%;height:80%">
                            </li>
                        </ul>

                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-light mb-4">歡迎線上訂位</h5>

                        <ul class="list-unstyled mb-0">
                            <li class="my-2">
                                <a href="#!" class="text-light ">關於我們</a>
                            </li>
                            <li class="my-2">
                                <a href="#!" class="text-light">加入我們</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-light mb-4">常見服務</h5>

                        <ul class="list-unstyled">
                            <li class="my-2">
                                <a href="#!" class="text-light">支援服務</a>
                            </li>
                            <li class="my-2">
                                <a href="#!" class="text-light">餐廳費用</a>
                            </li>
                            <li class="my-2">
                                <a href="#!" class="text-light">特殊需求</a>
                            </li>
                            <li class="my-2">
                                <a href="#!" class="text-light">餐廳協尋</a>
                            </li>
                            <li class="my-2">
                                <a href="#!" class="text-light">訂位服務</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-light mb-4">與我們互動</h5>
                        <ul class="list-unstyled">
                            <li class="my-2">
                                <a href="#!" class="text-light"> <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                        height="1em" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                    </svg> Facebook</a>
                            </li>
                            <li class="my-2">
                                <a href="#!" class="text-light"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                        height="1em" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                    </svg> Twitter</a>
                            </li>
                            <li class="my-2">
                                <a href="#!" class="text-light "><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                    </svg> Instagram</a>
                            </li>

                            <li class="my-2">
                                <a href="#!" class="text-light"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                        <path
                                            d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.122C.002 7.343.01 6.6.064 5.78l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                                    </svg> Youtube</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(255, 255, 255, 0.2)">版權所有 童翌展</div>
            <!-- Copyright -->
        </footer>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="{{ asset('js/jquery/jquery-3.5.1.min.js')}}"></script>
        <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
        <script src="{{ asset('js/jquery/jquery-ui.js') }}"></script>
        <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/code_reflesh.js') }}"></script>
        <!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
        <script src="{{asset('js/calender.js')}}"></script>
        <script src="{{asset('js/sweetalert2.min.js')}}"></script> 
        @if(session('message')=='success')
            <script>
                Swal.fire(
                    '歡迎進到後端',
                    'Welcome!!',
                    'success'
                )
            </script>
        @endif
        
        <script>
            function getval(obj){
                $("#date").val(obj.value);
                $("#calendar").addClass('noplay');
            }
            function getDate(){
                let date = new Date();
                let today = date.getFullYear() + "年" + date.getMonth() + "月" + date.getdate();
                return today;
            }
            
            $(document).ready(function() {
                $.extend({
                    'goAnchor': function(to, time) {
                        $obj = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
                        $($obj).animate({
                            scrollTop: to
                        }, time);
                    }
                });
            
                // $('#click').click(function() {
                //     $.goAnchor($('#target').offset().top, 1000);
                // });
                // $('#progress').click(function() {
                //     $.goAnchor($('#target').offset().top, 1000);
                // });
            });
            let bodyClass = document.body.classList,
                lastScrollY = 0;
            window.addEventListener('scroll', function(){
                var st = this.scrollY;
                /* 判斷是向上捲動，而且捲軸超過 200px */
                if( st < 10) {
                    bodyClass.remove('big');
                } 
                else{
                    bodyClass.add('big');
                }
                //lastScrollY = st;
            });
            setTimeout(function () {
                $(document).ready(function () {
                    // document.getElementById("loader").style.display = "none";
                    // document.getElementById("myDiv").style.display = "block";
                    $("#loader").hide();
                    $("#myDiv").show();
                });
            }, 1000);
            
            /* 驗證資料欄不能為空白*/
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
            $("#mobile").blur(function(){
                var mobile = $.trim($("#mobile").val());
                if(is_mobile(mobile)!==true){
                    $("#mobile_info").html("手機格式錯誤");
                    $("#submit2").attr('disabled',true);
                }
                else{
                    $("#mobile_info").html("");
                    $("#submit2").attr('disabled',false);
                    return false;
                }
            });
            function is_mobile(mobile){
                let re = /^[09]{2}[0-9]{8}$/;
                if( !(re.test(mobile)) ) {
                    return false;
                }
                else{
                    return true;
                }
            }
        </script>
    </body>
</html>

<!-- https://codertw.com/%E5%89%8D%E7%AB%AF%E9%96%8B%E7%99%BC/263580/ -->