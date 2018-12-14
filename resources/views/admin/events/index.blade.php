@extends('layouts.admin.admin')
@section('content')

@if (session('create_event'))
<div class="alert alert-success">
    {{ session('create_event') }}
</div>
@endif
@if (session('update_event'))
<div class="alert alert-success">
    {{ session('update_event') }}
</div>
@endif
@if(Session::has('deleted_event'))
<p class="bg-danger">{{session('deleted_event')}}</p>
@endif

<div class="container">
    <h1 style="color: #0099CC; text-align: center; margin:20px;">Quản lý sự kiện</h1>
</div>

<div class="content" style="width: 99%; margin: auto;">
    <table class="table"> 
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sự kiện</th>
                <th>Địa điểm</th>
                <th>Số lượng vé</th>
                <th>Mô tả</th>
                <th>Ảnh sự kiện</th>
                <th>Tài liệu</th>
                <th>Ngày diễn ra</th>
                <th>Ngày kết thúc</th>
                <th>Xem loại sự kiện</th>
                <th>Xem công ty tổ chức</th>
                <th>Ngày tạo</th>
                <th>Ngày cập nhật</th>
                <th colspan="2">Hành động</th>
            </tr>
        </thead>

        <tbody>
            @if(count($events) <= 0)
                <h2>Khong co ket qua</h2>
            @endif
            @if($events)
                @if(isset($is_search))
                    @foreach($events as $event)
                    <tr>
                        <td>{{$event->id}}</td>
                        <td>{{$event->title_event}}</td>  
                        <td>{{$event->location}}</td>
                        <td>Số lượng</td>
                        <td>{{$event->description}}</td>     
                        <td>
                            <img width="75" height="60" src="#" alt="">
                        </td>
                        <td>
                            Tài liệu
                        </td>
                        <td>{{$event->date_start}}</td>
                        <td>{{$event->date_end}}</td>
                        <td>
                            @if(($event->status) == 0)
                            Đã diễn ra
                            @else
                            Chưa diễn ra
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/admin/events/'.$event->id.'/type_event')}}">Xem loại sự kiện</a>
                        </td>
                        <td>
                            <a href="{{url('/admin/events/'.$event->id.'/companies')}}">Xem công ty tổ chức sự kiện</a>
                        </td>
                        <td>{{$event->created_at}}</td>
                        <td>{{$event->updated_at}}</td>
                        <td>
                            <button class="btn btn-warning"><a href="{{ url('admin/events/'.$event->id.'/edit') }}">Sửa</a></button>
                        </td>
                        <td>
                            <form action="{{ route('admin.events.destroy',$event->id) }}" method="POST">
                               <input type="hidden" name="_method" value="DELETE">
                                    {{ csrf_field() }}
                                <input type="submit" class="btn btn-danger" value="Xóa">
                            </form> 
                        </td>
                    </tr>
                    @endforeach
                @else
                    @foreach($events as $event)
                    <tr>
                        <td>{{$event->id}}</td>
                        <td>{{$event->title_event}}</td>  
                        <td>{{$event->location}}</td>
                        <td>Số lượng</td>
                        <td>{{$event->description}}</td>     
                        <td>
                            <img width="75" height="60" src="#" alt="">
                        </td>
                        <td>
                            Tài liệu
                        </td>
                        <td>{{$event->date_start}}</td>
                        <td>{{$event->date_end}}</td>
                        <td>
                            @if(($event->status) == 0)
                            Đã diễn ra
                            @else
                            Chưa diễn ra
                            @endif
                        </td>
                        <td>
                            <a href="{{url('/admin/events/'.$event->id.'/type_event')}}">Xem loại sự kiện</a>
                        </td>
                        <td>
                            <a href="{{url('/admin/events/'.$event->id.'/companies')}}">Xem công ty tổ chức sự kiện</a>
                        </td>
                        <td>{{$event->created_at}}</td>
                        <td>{{$event->updated_at}}</td>
                        <td>
                            <button class="btn btn-warning"><a href="{{ url('admin/events/'.$event->id.'/edit') }}">Sửa</a></button>
                        </td>
                        <td>
                            <form action="{{ route('admin.events.destroy',$event->id) }}" method="POST">
                               <input type="hidden" name="_method" value="DELETE">
                                    {{ csrf_field() }}
                                <input type="submit" class="btn btn-danger" value="Xóa">
                            </form> 
                        </td>
                    </tr>
                    @endforeach
                @endif
            @endif
        </tbody>
    </table>

    <div class="row">
        <div class="col-lg-6 col-sm-offset-5">
            {{ $events->render() }}
        </div>
    </div>
</div>
@stop