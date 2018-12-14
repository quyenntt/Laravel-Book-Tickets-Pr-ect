@extends('layouts.app')
@section('content')
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
 <!-- //header -->
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="index.html">Home</a><span>|</span></li>
				<li>Events</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
<!-- banner -->
	<div class="banner">
		<div class="w3l_banner_nav_left">
			<nav class="navbar nav_bottom">
			 <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header nav_2">
				  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
			   </div> 
			   <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<h4 style="line-height: 36px;">Company</h4>
					<ul class="nav navbar-nav nav_1">
						 @foreach($company as $data)
							<li><a href="{{route('events', $data->id)}}">{{$data->name_company}}</a></li>
						@endforeach
					</ul>
				 </div><!-- /.navbar-collapse -->
			</nav>
			<nav class="navbar nav_bottom">
			 <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header nav_2">
				  <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
			   </div> 
			   <!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<h4 style="line-height: 36px;">Type Events</h4>
					<ul class="nav navbar-nav nav_1">
						  @foreach($type_event as $type_event)
			                <li><a href="{{route('loaisanpham',$type_event->id)}}">{{$type_event->name_type_event}}</a></li>
			               @endforeach
					</ul>
				 </div><!-- /.navbar-collapse -->
			</nav>
		</div>
		<div class="w3l_banner_nav_right">
<!-- events -->
			<div class="events">
				<h3>Events</h3>
				<div class="events-bottom">
					@foreach($get_event as $data)
						<div class="col-md-6 events_bottom_left">
							<div class="col-md-4 events_bottom_left1">
								<div class="events_bottom_left1_grid">
									<h4>{{date('d',strtotime($data->date_start))}}</h4>
									<p>{{date('F,Y',strtotime($data->date_start))}}</p>
								</div>
							</div>
							<div class="col-md-8 events_bottom_left2">	
							<a href="{{route('detailevents',$data->id)}}" title="{{$data->title_event}}"><img src="{{$data->folder.$data->attached_file}}" alt=" " class="img-responsive" /></a>
								<h4>{{$data->title_event}}</h4>
								<ul>
									<li><i class="fa fa-clock-o" aria-hidden="true"></i>{{date('H:i:s',strtotime($data->date_start))}}</li>
									<li><i class="fa fa-user" aria-hidden="true"></i><a href="#">{{$data->location}}</a></li>
								</ul>
								<p>{{ str_limit($data->description, $limit = 106, $end = '...') }}<a href="{{route('detailevents',$data->id)}}" title="" class="link_watch" style="font-size: 16px;">xem thêm</a></p>
							</div>
							<div class="clearfix"> </div>
						</div>
					@endforeach
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>

		<div class="image_dynamic">
			<img src="images/source.gif" class="img-responsive" width="200px" ">				
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
<!-- Bootstrap Core JavaScript -->
<script src="js/admin/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
@endsection