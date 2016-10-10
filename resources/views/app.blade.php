<!DOCTYPE html>
<html lang="en">
<head>
    <title>Vehicles</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="{{url('/')}}/css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="{{url('/')}}/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/jquery.dataTables.css" />
    <link type="text/css" href="{{url('/')}}/css/theme.css" rel="stylesheet" />
</head>
<body>
<aside class="sidebar">
    <div class="logo">
        <a href="index.html">
            <img src="{{url('/')}}/images/logo.png" alt="" width="150">
        </a>
    </div>
    <nav class="main-nav">
        @if(Auth::check())
            <ul class="tab-list">
                <li><a href="{{url('/')}}">Home </a></li>
                @if($user->can('view','customers'))<li class=""><a href="vehicles-list.html">Customers </a></li> @endif
                @if($user->can('view','franchises'))<li class=""><a href="vehicles-list.html">Franchises </a></li> @endif
                @if($user->can('view','vehicles'))<li class="active"><a href="{{url('/')}}/vehicles">Vehicles </a></li> @endif
                @if($user->can('view','onlineStore')) <li><a href="store.html">Online Store </a></li> @endif
                @if($user->can('view','products')) <li><a href="store.html">View Store</a></li> @endif
                @if($user->can('view','orders')) <li><a href="store.html">View Orders</a></li> @endif
                @if($user->can('view','newsletters')) <li><a href="store.html">Newsletters</a></li> @endif
                @if($user->can('view','customerServicesRequests'))
                    <li>
                        <a href="store.html">
                            @if($user->isFranchise())
                                Customers Service Requests
                            @elseif($user->isCustomer())
                                My Service Requests
                            @endif
                        </a>
                    </li>
                @endif
                @if($user->can('view','manuals')) <li><a href="store.html">Manuals</a></li> @endif
                @if($user->can('view', 'messages'))
                <li>
                    <a href="">
                        @if($user->isCustomer())
                            Contact a Franchise
                        @elseif($user->isFranchise())
                            Customer Messages
                        @endif
                    </a>
                    <ul>
                        <li><a href="store.html">Older Messages</a></li>
                        <li><a href="frenchise.html">Create New Messages</a></li>
                    </ul>
                </li>
                @endif
                <li class=""><a href="vehicles-list.html">Logout</a></li>
            </ul>
        @endif
    </nav>
</aside>
<main class="main-content">
    <div class="user-widget">
        <div class="user-bg">
            <ul class="ul-items">
                <li><a href="#"><i class="fa fa-facebook fa-fw"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter fa-fw"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin fa-fw"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus fa-fw"></i></a></li>
            </ul>
            @if(Auth::check())
                <div class="dropdown user-info">
                    <a class="dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">
                        <span>{{Auth::user()->f_name}} {{Auth::user()->l_name}}</span>
                        <figure><img src="{{url('/')}}/images/profile.jpg" alt=""></figure>
                        <i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                        <li><a href="#">Edit Profile</a></li>
                        <li><a href="#">Messages <span>22</span></a></li>
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
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/jquery.min.js"></script>
<script src="{{url('/')}}/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/jquery.dataTables.js"></script>
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
</body>
</html>
