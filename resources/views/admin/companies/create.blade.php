@extends('layouts.admin.admin')

@section('content')

<div class="container">
    <h1>Tạo mới công ty</h1>
    <form method="post" action="{{ url('/admin/companies')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-8">
                <div class=" form-group {{ $errors->has('name_company') ? 'has-error' : '' }}">
                    <label>Tên công ty:</label>
                    <input type="text" id="name_company" name="name_company" class="form-control" placeholder="Nhập tên công ty..." value="{{ old('name_company') }}">
                    <span class="text-danger">{{ $errors->first('name_company') }}</span>
                </div>  

                <div class=" form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label>Thư điện tử:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Nhập địa chỉ thư điện tử..." value="{{ old('email') }}">
                    <span class="text-danger">{{$errors->first('email')}}</span>
                </div>

                <div class=" form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label>Số điện thoại:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại liên hệ..." value="{{ old('phone') }}">
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                </div>

                <div class=" form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label>Địa chỉ:</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Nhập địa chỉ..." value="{{old('address')}}">
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group {{ $errors->has('name_file') ? 'has-error' : ''}}">
                    <label>Tên ảnh:</label>
                    <input type="text" class="form-control" name="name_file" id="name_file" value="{{old('name_file')}}" placeholder="Nhập tên ảnh...">
                    <span class="text-danger">{{$errors->first('name_file')}}</span>
                </div>
                
                <div class=" form-group {{ $errors->has('attached_file') ? 'has-error' : '' }}">
                    <label>Ảnh công ty:</label>
                        <input type="file" class="form-control" name="attached_file[]" multiple>
                    <span class="text-danger">{{ $errors->first('attached_file') }}</span>
                </div> 
            </div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Lưu" />
        </div>
    </form>
</div>
@stop