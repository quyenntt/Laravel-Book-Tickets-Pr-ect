
@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/slide_company.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<!-- Show hình ảnh, tên sự kiện, ngày bắt đầu sự kiện, địa điểm diễn ra sự kiện 
tại đây có một nút button để mua vé (chuyển đến trang mua vé) -->
<div class="inner-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 img-thumbnail">
				<img src="{{$event_details->folder.$event_details->attached_file}}" alt="" style="width: 100%; height: 450px;" class="img-responsive">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1 col-sm-1 col-md-2 col-lg-1">
				<img src="{{asset('assets/images/overtime.png')}}" alt="" class="img-responsive" style="margin-top: 20px">
			</div>
			<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
				<h3 class="title_e">{{$event_details->title_event}}</h2>
				<h4 class="calendar"><i class="fa fa-calendar" aria-hidden="true">&nbsp;&nbsp;</i><span>{{date('H:i',strtotime($event_details->date_start))}}</span> {{date('d-m-Y',strtotime($event_details->date_start))}}</h3>
				<h4 class="location"><i class="material-icons">&#xe55e;</i>&nbsp;{{$event_details->location}}</h3>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<a href="{{route('chooseticket',$event_details->id)}}" class="btn btn-lg" style="margin-top: 70px; margin-left: 20px; border-radius: 0px;width: 50%; background-color: #dd0a37; color: white">Mua vé ngay</a>
			</div>
		</div>
	</div>
	<br/>
	<div class="panel panel-default">
		<div class="panel-body">
			  <ul class="top-details menu-beta list-inline">
	            <li><a href="#">Giới thiệu</a></li>
	            <li class="hidden-xs">
	             <a href="#">Thông tin vé</a>
	            </li>
	            <li class="hidden-xs">
	              <a href="#">Nhà tổ chức</a>
	            </li>
          </ul>
		</div>
	</div>
</div>
<!-- End -->
<!-- Có 2 phần: 1.Show chi tiết về sự kiện: mô tả sự kiện, ngày bắt đầu ngày kết thúc, số điện thoại, Fanpage của sự kiện hoặc công ty tổ chức sự kiện, 2. Show những sự kiện nổi bật -->
<div class="container-fluid">
	<div class="row">
		<!-- Show chi tiết sự kiện -->
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="text-center"><b>Giới thiệu</b></h3>
				</div>
				<div class="single-item-desc" style="padding-left: 10px; padding-right: 10px;">
					<p class="text_des">{{$event_details->description}}</p>
					<p class="text_des"><b>Địa chỉ:</b> <span>{{$event_details->location}}</span></p>
					<p class="text_des">Ngày bắt đầu vào lúc:&nbsp;<b>{{date('H:i',strtotime($event_details->date_start))}}&nbsp;</b> ngày<b>{{date('d-m-Y',strtotime($event_details->date_start))}}</b></p>
					<p class="text_des"><b>Ngày kết thúc:</b> {{$event_details->date_end}}</p>
					<p class="text_des"><b>Trang chủ:</b> contact@devday.org</p>
					<p class="text_des"><b>Vui lòng liên hệ đến số điện thoại:</b>(84) 236 7109 123 | (84) 935 102 044</p>
					<p class="text_des">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet. </p>
				</div>
			</div>
		</div>
		<!-- End show chi tiết sự kiện -->
		<!-- Show những sự kiện nổi bật -->
		<div class="col-sm-3 aside">
			<div class="widget">
				<h3 class="text-center"><b>Sự kiện nổi bật</b></h3>
				<div class="widget-body">
					<div class="beta-sales beta-lists">
						@foreach($eventall as $query1)
							<div class="media beta-sales-item">
								<a class="pull-left" href="{{route('detailevents',$query1->id)}}"><img src="{{$query1->folder.$query1->attached_file}}" alt="" class="img-responsive"></a>
								<div class="media-body">
									<p class="name_event">{{$query1->title_event}}<p>
									
								</div>

							</div>
						@endforeach

					</div>
				</div>
			</div>
		</div>
		<!-- End những sự kiện nổi bật -->

		<div class="clearfix">
		</div>
</div>	
<!-- End mô tả chi tiết sự kiện-->
<!-- Show hình ảnh công ty liên quan đến sự kiện -->
<!-- Button like -->
<div class="row">
	<div class="like" id="like">
		<button class="btn Event_like" id="Event_like{{$event_details->id}}" value="{{$event_details->id}}"><i class="fas fa-thumbs-up" style="font-size: 40px;"></i></button>
		<input type="hidden" id="id_user{{$event_details->id}}" value="@if(Auth::check()){{Auth::user()->id}}@endif">
		<span class="id_like" id="id_like{{$event_details->id}}">@if($count){{$count[0]->CountLike}} @else 0 @endif</span>
	</div>
</div>
<!-- End like -->
<div class="container-fluid">
	<div class='row'>
		<div class=" col-md-12 panel panel-default">
			<div class="panel-heading">
				<h3 class="text-center"><b>Các công ty liên quan</b></h3>
				</div>
			  	<div class="carousel media-carousel" id="media">
			        <div class="carousel-inner">
			          <div class="item active">
			            <div class="row">
			            	@foreach($companies as $companie)
							    <div class="col-md-4">
			                  		<a class="thumbnail" href="#"><img src="{{$companie->folder.$companie->attached_file}}" alt="" class="img-responsive" ></a>
			              		</div>   
							@endforeach
			                    
			            </div>
			          </div>
			  		</div>
				</div>
		</div>                          
	</div>
</div>

<script>
	$(document).on('click', '.Event_like', function () {
    var event_id = $(this).val();
    var id_user  = '#id_user'+ event_id;
    var user     = $(id_user).val();
  	if(user){
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    })

	    $.ajax({
	        type: "get",
	        url:  "{{URL::to('likeEvent')}}/"+ event_id,
	        dataType: "json",
	        data: {event_id: event_id, id_user:user},
	        success: function (data) { // What to do if we succeed
	            console.log(data.Amountdemlike);
	            if(data.dem==0){
	            	var like = '<i class="fas fa-thumbs-up" style="font-size: 40px;"></i>';
						$('#Event_like'+ data.event_id).html(like);
						$('#id_like'+ data.event_id).html(data.Amountdemlike);

	            }
	            else
	            {
	            	var like = '<i class="fa fa-thumbs-down" style="font-size: 40px;"></i>';
						$('#Event_like'+ data.event_id).html(like);
						$('#id_like'+ data.event_id).html(data.Amountdemlike);
	            }

	        },
	    })
	}
	else {
		alert("Bạn cần đăng nhập trước khi like.Cảm ơn");
	}
});
</script>
@endsection
