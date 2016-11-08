<!DOCTYPE html>
<html lang="en">
<head>
    <title>Vehicles</title>
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
                <li><a href="{{url('/')}}">Home </a></li>

                @if($user->can('view','customers'))<li class=""><a href="{{url('/')}}/customers">Customers </a></li> @endif
                @if($user->can('view','franchises'))<li class=""><a href="{{url('/')}}/franchises">Franchises </a></li> @endif
                @if($user->can('view','vehicles'))<li class="active"><a href="{{url('/')}}/vehicles">Vehicles </a></li> @endif
                @if($user->can('view','products'))
                    <li>
                        <a href="{{url('/')}}/products">
                            @if($user->isCustomer())
                                Online Store
                            @else
                                Store
                            @endif
                        </a>
                    </li>
                @endif
                @if($user->can('view','orders')) <li><a href="{{url('/')}}/orders">View Orders</a></li> @endif
                @if($user->can('view','newsletters'))
                    <li>
                        <a href="{{url('/')}}/newsletters">
                            Newsletters
                        </a>
                    </li>
                @endif
                @if($user->can('view','serviceRequest'))
                    <li>
                        <a href="{{url('/')}}/service_requests">
                            @if($user->isFranchise())
                                Customers Service Requests
                            @elseif($user->isCustomer())
                                My Service Requests
                            @endif
                        </a>
                    </li>
                @endif
                @if($user->can('view','manuals')) <li><a href="{{url('/')}}/manuals">Manuals</a></li> @endif
                @if($user->can('view', 'messages'))
                    <li>
                        <a href="#">
                            @if($user->isCustomer())
                                Contact a Franchise
                            @elseif($user->isFranchise())
                                Customer Messages
                            @endif
                        </a>
                        <ul>
                            <li><a href="{{url('/')}}/messages">Older Messages</a></li>
                            <li><a href="{{url('/')}}/create-new-message">Create New Messages</a></li>
                        </ul>
                    </li>
                @endif
                @if($user->can('view','cart'))
                    <li>
                        <a href="{{url('/')}}/cart">
                            Cart
                        </a>
                    </li>
                @endif
                <li class=""><a href="{{url('/')}}/logout">Logout</a></li>
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
                        <figure><img src="{{url('/')}}/images/profile.jpg" alt=""></figure>
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
                targets: [ 4 ],
                orderData: [ 4, 0 ]
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