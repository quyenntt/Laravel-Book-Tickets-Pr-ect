<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <base href="{{asset('')}}">
  <meta name="_token" content="{{ csrf_token() }}" />  
  @include('layouts.link')
</head>
<body>

@include('layouts.header')
 
    <ul class="top_icons">
      <li><a href="#"><span class="fa fa-facebook" aria-hidden="true"></span></a></li>
      <li><a href="#"><span class="fa fa-twitter" aria-hidden="true"></span></a></li>
      <li><a href="#"><span class="fa fa-linkedin" aria-hidden="true"></span></a></li>
      <li><a href="#"><span class="fa fa-google-plus" aria-hidden="true"></span></a></li>
    </ul>

<!-- Feature events -->
<div class="wrapper_top_w3layouts">
  <div class="container-fluid">
    <div class="news" id="news">
      <div class="container">
        <div class="w3-welcome-heading">
          <h3> <span>Sự Kiện</span> <span style="color: #dd0a37;">Nổi Bật</span></h3>
        </div>
        <div class="row">
          <div class="agile-news-grid">
            @if($eventall)
              @foreach($eventall as $query1)
              <div class="col-md-6 agile-news-left">
                <div class="col-md-6 ">
                  <div class="news-left-img" style="background: url({{$query1->folder.$query1->attached_file}}) no-repeat 0px 0px; background-size: contain;">
                    <div class="news-left-text">
                      <a href="{{route('detailevents',$query1->id)}}" class="title_event"><h5>{{$query1->title_event}}</h5></a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 news-grid-info-bottom">
                  <div class="news-left-top-text">
                    <a href="#" data-toggle="modal" data-target="#myModal">{{$query1->location}}</a>
                  </div>
                  <div class="date-grid">
                    <div class="admin">
                      <a href="#"><i class="fa fa-user" aria-hidden="true"></i> Admin</a>
                    </div>
                    <div class="time">
                      <p><i class="fa fa-calendar" aria-hidden="true"></i> {{date('d-m-Y H::i',strtotime($query1->date_start))}}</p>
                    </div>
                    <div class="clearfix"> </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-5 like" id="like">
                      <button class="btn Home_Like" id="Home_Like{{$query1->id}}" value="{{$query1->id}}"><i class="fa fa-thumbs-up" style="font-size: 10px;"></i></button>
                      <input type="hidden" id="id_user_Home{{$query1->id}}" value="@if(Auth::check()){{Auth::user()->id}}@endif">
                      <span class="id_like_Home" id="id_like_Home{{$query1->id}}">1</span>
                    </div>
                    <div class="col-sm-7 comment">
                      <button class="btn Home_Like" id="Home_Like{{$query1->id}}" value="{{$query1->id}}"><i class="fa fa-comment" style="font-size: 10px;"></i></button>
                        <span class="id_like" id="id_like_Home{{$query1->id}}">1</span>
                    </div>
                  </div>
                  <div class="news-grid-info-bottom-text">
                    <p>{{ str_limit($query1->description, $limit = 100, $end = '...') }}<a href="{{route('detailevents',$query1->id)}}" title="" class="link_watch">xem thêm</a></p>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div> 
</div>
<div class="clearfix"></div>    
<!-- End show feature events -->
  <!-- Speakers -->
<div class="clearfix"></div>
  <div>
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- section title -->
        <div class="w3-welcome-heading">
         <h3> <span>Sự Kiện</span> <span style="color: #dd0a37;">Mới</span></h3>
        </div>
        <!-- section title -->

        <!-- speaker -->
        @if(count($newevent) == 0)
          @foreach($newevent as $new_event)
          <div class="col-md-3 col-sm-5">
            <div class="speaker" data-toggle="modal" data-target="#speaker-modal-1">
              <div class="speaker-img">
                <a href="{{route('detailevents',$new_event->id)}}"><img src="{{$new_event->folder.$new_event->attached_file}}" alt="service-img" class="img-responsive"></a>
             <!--    <img src="./img/1.jpg" alt=""> -->
              </div>
              <div class="speaker-body">
                <div class="speaker-social">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-instagram"></i></a>
                  <a href="#"><i class="fa fa fa-linkedin"></i></a>
                </div>
                <div class="speaker-content">
                  <a href="{{route('detailevents',$new_event->id)}}" class="title_event"><h5>{{$new_event->title_event}}</h5></a>
                  <span>{{date('d-m-Y',strtotime($new_event->date_start))}}</span>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        @else
          @foreach($newevent as $new_event)
          <div class="col-md-3 col-sm-5">
          <div class="speaker" data-toggle="modal" data-target="#speaker-modal-1">
            <div class="speaker-img">
              <a href="{{route('detailevents',$new_event->id)}}"><img src="{{$new_event->folder.$new_event->attached_file}}" alt="service-img" class="img-responsive"></a>
           <!--   <img src="./img/2.jpg" alt=""> -->
            </div>
            <div class="speaker-body">
              <div class="speaker-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa fa-linkedin"></i></a>
              </div>
              <div class="speaker-content">
                <a href="{{route('detailevents',$new_event->id)}}" class="title_event"><h5>{{$new_event->title_event}}</h5></a>
                <span>{{date('d-m-Y',strtotime($new_event->date_start))}}</span>
              </div>
            </div>
          </div>
        </div>
         @endforeach
         @endif
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
<!-- End show new events -->
<!-- Start slide -->
<div class="clearfix" style="margin-top: 20px;"></div>
@include('layouts.slide_event')
<!-- End slide -->
<!-- Include Footer -->
@include('layouts.footer')
</body>
</html>