@extends('layouts.admin.admin')
@section('content')

<div class="container">
    <h1>Quản lý công ty</h1>
</div>
<div class="contain">
    @if (session('create_company'))
    <div class="alert alert-success">
        {{ session('create_company') }}
    </div>
    @endif
    @if (session('update_company'))
    <div class="alert alert-success">
        {{ session('update_company') }}
    </div>
    @endif
    @if(Session::has('deleted_company'))
    <p class="bg-danger">{{session('delete_company')}}</p>
    @endif
    <table class="table"> 
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên công ty</th>
                <th>File ảnh</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Ngày tạo</th>
                <th>Ngày cập nhật</th>
                <th colspan="2">Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($companies as $company)
            <tr>
                <td>{{$company->id}}</td>
                <td>{{$company->name_company}}</td>        
                <td>
                    <img width="75" height="60" src="{{$company->company_image()? asset( $company->company_image()->folder.$company->company_image()->attached_file): 'http://placehold.it/400x400'}}" alt="">
                </td>
                <td>{{$company->phone}}</td>
                <td>{{$company->email}}</td>
                <td>{{$company->address}}</td>
                <td>{{$company->created_at}}</td>
                <td>{{$company->updated_at}}</td>
                <td>
                    <a href="{{ url('admin/companies/'.$company->id.'/edit') }}">Chỉnh sửa</a>
                </td>
                <td>
                    <form action="{{ route('admin.companies.destroy',$company->id)}}" method="POST">
                       <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger" value="Xóa">
                    </form> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-lg-6 col-sm-offset-5">
            {{ $companies->render() }}
        </div>
    </div>
</div>
@stop