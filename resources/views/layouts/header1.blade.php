
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />
<div class="header-top">
  <div class="container">
    <div class="pull-left auto-width-left">
      <ul class="top-menu menu-beta l-inline">
        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Trang chủ</a></li>
        <li><a href="#"><i class="fa fa-sitemap"></i> Sitemap</a></li>
      </ul>
    </div>
    <div class="pull-right auto-width-right">
      <ul class="top-details menu-beta l-inline">
        @if(Auth::check())
          @if(Auth::user()->role==0)
            <li><a href="">Chào bạn {{Auth::user()->username}}</a></li>
            <li>
              <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Đăng xuất
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
            </li>
            @endif
      @endif
      </ul>
    </div>
    <div class="clearfix"></div>
  </div> <!-- .container -->
</div> <!-- .header-top -->

<div class="banner_top innerpage" id="home">
  <div class="wrapper_top_w3layouts">
    <div class="header_agileits">
      <div class="logo">
        <h1><a class="navbar-brand" href="#"><span>Event</span> <i>Tomorrow</i></a></h1>
      </div>
 
        <!-- cart details -->
        <div class="top_nav_right">
        <div class="shoecart shoecart2 cart cart box_1">
          <form action="#" method="post" class="last">
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="display" value="1">
            <a class="top_shoe_cart" href="{{route('shopping_cart')}}" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i><span class="dem">@if (Session::has('cart')){{Session('cart')->totalQty}}
                @else 0 @endif</span></a>
          </form>
        </div>
      </div>
        <!-- //cart details -->
      <div class="clearfix"></div>
    </div>
    <!-- //search -->
  </div>
</div>

<!-- products-breadcrumb -->
<div class="products-breadcrumb">
  <div class="container">
    <ul>
      <li><i class="fa fa-home" aria-hidden="true"></i><a href="{{url('/')}}">Trang chủ</a><span>|</span></li>
          <li><a href="{{url('/getallevent')}}">Sự kiện</a><span>|</span></li>
          <li><a href="{{route('about')}}">Về chúng tôi</a><span>|</span></li>
          <li><a href="{{url('/addcontact')}}">Liên hệ</a><span>|</span></li>
    </ul>
  </div>
</div>
<!-- //products-breadcrumb -->