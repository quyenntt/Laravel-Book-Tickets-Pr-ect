@extends('layouts.admin.admin')
@section('content')
<h1 style="color: #0099CC; text-align: center; margin-top: 10px;">Quản lý nhóm</h1>
@if (session('create_group'))
<div class="alert alert-success">
    {{ session('create_group') }}
</div>
@endif
@if (session('update_group'))
<div class="alert alert-success">
    {{ session('update_group') }}
</div>
@endif
@if (Session::has('deleted_group'))
<p class="bg-danger">{{session('deleted_group')}}</p>
@endif

<div class="content" style="width: 90%; margin: auto;">
    <div class="form-group">
        <table class="table"> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên nhóm</th>
                    <th>Các hành động của nhóm</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th colspan="2">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @foreach($groups as $group)
                <tr>
                    <td>{{$group->id}}</td>
                    <td>{{$group->name_group}}</a></td> 
                    <td><a href="{{url('/admin/groups/'.$group->id.'/action')}}">Xem hành động</a></td>     
                    <td>{{$group->description}}</td>
                    <td>{{$group->created_at}}</td>
                    <td>{{$group->updated_at}}</td>
                    <td>
                        <a href="{{ url('admin/groups/'.$group->id.'/edit') }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.groups.destroy',$group->id) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                            <input type="submit" class="btn btn-danger" value="Xóa">
                        </form> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-offset-5">
            {{ $groups->render() }}
        </div>
    </div>
</div>
@stop