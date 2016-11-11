<!DOCTYPE html>
<html lang="en">
<head>
    <title>Towfix | If you can tow it, we can fix it.</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="{{url('/')}}/css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="{{url('/')}}/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{url('/')}}/css/jquery.fancybox.css">
    <link type="text/css" href="{{url('/')}}/css/theme.css" rel="stylesheet" />
    <link type="text/css" href="{{url('/')}}/css/responsive.css" rel="stylesheet" />

    <!-- datetimepicker cs  -->
    <link type="text/css" href="{{url('/')}}/css/datepicker.css" rel="stylesheet" />
    <link type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" rel="stylesheet" />



    <script type="text/javascript" language="javascript" src="{{url('/')}}/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/jquery.bxslider.min.js"></script>

    <!-- datetimepicker js  -->
    <script type="text/javascript" src="http://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/jquery.ui.timepicker.addon.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/jquery.ui.timepicker.addon.i18n.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/jquery.ui.sliderAccess.js"></script>

    <!-- Select2 Links  -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>



    {{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
    <script src="{{url('/')}}/js/env.js"></script>
</head>
<body>
<aside class="sidebar">
    <div class="logo mobile-nav">
        <span class="nav-btn"><i class="fa fa-navicon"></i></span>
        <a href="{{url('/')}}">
            <img src="{{url('/')}}/images/logo.png" alt="" width="150">
        </a>
    </div>
    <nav class="main-nav">
        @if(Auth::check())
            <ul class="tab-list">
                <li class="@if(Request::segment(1) == '') active @endif"><a href="{{url('/')}}"><i class="fa fa-home fa-fw"></i> Home </a></li>

                @if($user->can('seeAll','customers'))<li class="@if(Request::segment(1) == 'customers' || Request::segment(1) == 'customer') active @endif"><a href="{{url('/')}}/customers"><i class="fa fa-users fa-fw"></i> Customers</a></li> @endif
                @if($user->can('view','franchises'))<li class="@if(Request::segment(1) == 'franchises' || Request::segment(1) == 'franchise') active @endif"><a href="{{url('/')}}/franchises"><i class="fa fa-building fa-fw"></i> Franchises</a></li> @endif
                @if($user->can('view','vehicles'))<li class="@if(Request::segment(1) == 'vehicles' || Request::segment(1) == 'vehicle') active @endif"><a href="{{url('/')}}/vehicles"><i class="fa fa-car fa-fw"></i> Vehicles</a></li> @endif
                @if($user->can('view','products'))
                    <li class="@if(Request::segment(1) == 'products' || Request::segment(1) == 'product') active @endif">
                        <a href="{{url('/')}}/products">
                            <i class="fa fa-shopping-bag fa-fw"></i>
                            @if($user->isCustomer())
                                Online Store
                            @else
                                Store
                            @endif
                        </a>
                    </li>
                @endif
                @if($user->can('view','orders')) <li class="@if(Request::segment(1) == 'orders' || Request::segment(1) == 'order') active @endif"><a href="{{url('/')}}/orders"><i class="fa fa-newspaper-o fa-fw"></i> View Orders</a></li> @endif
                @if($user->can('view','newsletters'))
                    <li class="@if(Request::segment(1) == 'newsletters' || Request::segment(1) == 'newsletter') active @endif">
                        <a href="{{url('/')}}/newsletters">
                            <i class="fa fa-file-text fa-fw"></i>
                            Newsletters
                        </a>
                    </li>
                @endif
                @if($user->can('view','serviceRequest'))
                    <li class="@if(Request::segment(1) == 'service_requests' || Request::segment(1) == 'service_request') active @endif">
                        <a href="{{url('/')}}/service_requests">
                            <i class="fa fa-newspaper-o fa-fw"></i>
                            @if($user->isFranchise())
                                Customers Service Requests
                            @elseif($user->isCustomer())
                                My Service Requests
                            @endif
                        </a>
                    </li>
                @endif
                @if($user->can('view','manuals')) <li class="@if(Request::segment(1) == 'manuals' || Request::segment(1) == 'manual') active @endif"><a href="{{url('/')}}/manuals"><i class="fa fa-file-word-o fa-fw"></i> Manuals</a></li> @endif
                @if($user->can('view', 'messages'))
                    <li class="">
                        <a href="#">
                            <i class="fa fa-wechat fa-fw"></i>
                            @if($user->isCustomer())
                                Contact a Franchise
                            @elseif($user->isFranchise())
                                Customer Messages
                            @endif
                        </a>
                        <ul>
                            <li class="@if(Request::segment(1) == 'messages') active @endif"><a href="{{url('/')}}/messages">Older Messages</a></li>
                            <li class="@if(Request::segment(1) == 'create-new-message') active @endif"><a href="{{url('/')}}/create-new-message">Create New Messages</a></li>
                        </ul>
                    </li>
                @endif
                @if($user->can('view','cart'))
                    <li class="@if(Request::segment(1) == 'cart') active @endif">
                        <a href="{{url('/')}}/cart">
                            <i class="fa fa-cart-arrow-down fa-fw"></i>
                            Cart
                        </a>
                    </li>
                @endif
                <li class=""><a href="{{url('/')}}/logout"><i class="fa fa-shopping-bag fa-fw"></i> Logout</a></li>
            </ul>
        @endif
    </nav>
</aside>
<main class="main-content">
    <div class="user-widget">
        <div class="user-bg">
            <ul class="ul-items tablet-hide">
                <li><a href="#"><i class="fa fa-facebook fa-fw"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter fa-fw"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin fa-fw"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus fa-fw"></i></a></li>
            </ul>
            <div class="tablet-logo mobile-nav">
                <span class="nav-btn"><i class="fa fa-navicon"></i></span>
                <a href="{{url('/')}}">
                    <img src="{{url('/')}}/images/logo.png" alt="" width="150">
                </a>
            </div>
            @if(Auth::check())
                <div class="dropdown user-info">
                    <a class="dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">
                        <span>{{Auth::user()->f_name}} {{Auth::user()->l_name}}</span>

                        <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                        <li><a href="{{url('/')}}/customer/edit/{{$user->id}}">Edit Profile</a></li>
                        @if($user->can('view', 'messages'))
                            <li><a href="{{url('/')}}/messages">Messages <span>22</span></a></li>
                        @endif
                        <li><a href="{{url('/')}}/logout">Logout</a></li>
                    </ul>
                </div>
            @else
                <ul class="account-list">
                    <li class="active"><a href="{{url('/')}}/login"><i class="fa fa-user fa-fw"></i> Login</a></li>
                    <li><a href="{{url('/')}}/register"><i class="fa fa-lock fa-fw"></i> Register</a></li>
                </ul>
            @endif
            <div class="head-cart">
            	<a href="{{url('/')}}/cart"><i class="fa fa fa-cart-arrow-down"></i> Cart</a>
            </div>
        </div>
    </div>
    @yield('page')
</main>
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>-->
<script src="{{url('/')}}/js/bootstrap.min.js"></script>

<script type="text/javascript" language="javascript" src="{{url('/')}}/js/jquery.fancybox.js"></script>
<script>
    $(document).ready(function(){
        $('#tableStyle').DataTable( {
            columnDefs: [ {
                targets: [ 0 ],
                orderData: [ 0, 1 ]
            }, {
                targets: [ 1 ],
                orderData: [ 1, 0 ]
            }, {
                targets: [ 2 ],
                orderData: [ 2, 0 ]
            } ]
        });
        $('header button').click(function(){
            $('aside').toggleClass('custom-menu');
            $('main').toggleClass('main-margin');
        });
    });
</script>
<script src="<?php echo asset('js/towfix.js') ?>"> </script>

</body>
</html>