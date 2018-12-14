@extends('layouts.admin.admin')

@section('content')
<div class="container">
    <h1>Sửa thông tin công ty</h1>
    <form action="{{ route('admin.companies.update', $company->id) }}" method="post" enctype='multipart/form-data'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="col-md-8">
                <div class=" form-group {{ $errors->has('name_company') ? 'has-error' : '' }}">
                    <label>Tên công ty:</label>
                    <input type="text" id="name_company" name="name_company" class="form-control" value="{{ $company->name_company }}" required>
                    <span class="text-danger">{{ $errors->first('name_company') }}</span>
                </div>            

                <div class=" form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label>Số điện thoại:</label>
                    <input type="tel" class="form-control" rows="5" id="phone" name="phone" value="{{ $company->phone }}" required>
                    <span class="text-danger">{{ $errors->first('phone')}}</span>
                </div>

                <div class=" form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label>Email:</label>
                    <input type="email" class="form-control" rows="5" id="email" name="email" value="{{ $company->email }}" required>
                    <span class="text-danger">{{ $errors->first('email')}}</span>
                </div>

                <div class=" form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label>Địa chỉ:</label>
                    <input type="text" class="form-control" rows="5" id="address" name="address" value="{{ $company->address }}" required>
                    <span class="text-danger">{{ $errors->first('address')}}</span>
                </div> 
            </div>
            
            <div class="col-md-4">
                <div class=" form-group {{ $errors->has('name_file') ? 'has-error' : '' }}">
                    <label>Tên file ảnh:</label>
                    <input type="text" id="name_file" name="name_file" class="form-control" value="{{ $company->company_image()? $company->company_image()->name_file:'No Name'}}" required>
                    <span class="text-danger">{{ $errors->first('name_file') }}</span>
                </div> 

                <div class="  form-group {{ $errors->has('attached_file') ? 'has-error' : ''}}">
                    <label>Chọn file ảnh (có thể upload nhiều ảnh):</label>
                    <input type="file" id="attached_file" name="attached_file[]" class="form-control" value="{{$company->company_image()? $company->company_image()->attached_file:'UnImage' }}" multiple>
                    <span class="text-danger">{{ $errors->first('attached_file') }}</span>
                </div> 

                @if($company_images)
                    @foreach($company_images as $company_image)
                    <div class="form-group" style="width:200px">
                        <img src="{{asset($company_image->folder.$company_image->attached_file)}}" height="300" alt="" class="img-responsive img-rounded">
                    </div><br>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Cập nhật" />
        </div>
    </form>
</div>
@stop