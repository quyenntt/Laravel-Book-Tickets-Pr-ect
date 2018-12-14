@extends('layouts.admin.admin')
@section('content')
<h1 style="color: #0099CC; text-align: center; margin:20px;">Thêm sự kiện</h1>

    <div class="container" style="margin-left:20px; margin-top: 15px;">
        <form action="{{ url('/admin/events') }}" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="add-event">
                <div class="create-event">
                    <h2>Nhập thông tin sự kiện:</h2>
                    <div class="row form-group">
                        <div class="col-md-5 {{ $errors->has('title_event') ? 'has-error' : '' }}">
                            <label>Tên sự kiện:</label>
                            <input type="text" id="title_event" name="title_event" class="form-control" placeholder="Nhập tên sự kiện..." value="{{ old('title_event')}}" required>
                            <span class="text-danger">{{ $errors->first('title_event') }}</span>
                        </div> 
                        <div class="col-md-5 {{ $errors->has('location') ? 'has-error' : '' }}">
                            <label>Địa điểm tổ chức:</label>
                            <input type="text" id="location" name="location" class="form-control" placeholder="Nhập địa điểm..." value="{{ old('location') }}">
                            <span class="text-danger">{{ $errors->first('location') }}</span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-5  {{$errors->has('date_start') ? 'has-error' : ''}}">
                            <label>Thời gian bắt đầu:</label>
                            <input type="text" name="date_start" id="date_start" value="{{old('date_start')}}">
                            <span class="text-danger">{{ $errors->first('date_start') }}</span>
                        </div>

                        <div class="col-md-5 {{$errors->has('date_end') ? 'has-error' : ''}}">
                            <label>Thời gian kết thúc:</label>
                            <input type="text" name="date_end" id="date_end" value="{{old('date_end')}}">
                            <span class="text-danger">{{ $errors->first('date_end') }}</span>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class=" exmple col-md-5 {{$errors->has('type_event_id') ? 'has-error' : ''}}">
                            <label>Loại sự kiện:</label>
                            <select id="type_event1" name="type_event_id[]" multiple="multiple">
                                <optgroup label="Phổ biến">
                                @foreach ($type_events as $type_event)
                                    <option value="{{$type_event->id}}">
                                        {{$type_event->name_type_event}}
                                    </option>
                                @endforeach 
                                </optgroup>
                            </select>
                        </div>

                        <div class=" example col{{$errors->has('company_id') ?'has-error' :''}}">
                            <label>Công ty tổ chức:</label>
                            <select id="company_id" name="company_id[]" multiple="multiple">
                                <optgroup label="Đối tác">
                                @foreach ($companies as $company)     
                                    <option value="{{$company->id}}">
                                        {{$company->name_company}}
                                    </option>
                                @endforeach  
                                </optgroup>
                            </select>
                            <span class="text-danger">{{ $errors->first('company_id') }}</span>
                        </div> 
                    </div>
                    
                    <div class="row form-group ">
                        <div class="col-md-5">
                            <div class="$errors->has('name_image') ? 'has-error' : '' }}">
                                <input type="text" name="name_image" placeholder="Nhập tên file..." value="{{old('name_image')}}">
                                <span class="text-danger">{{$errors->first('name_image')}}</span>
                            </div>

                            <div class=" {{ $errors->has('file_image') ? 'has-error' : '' }}">
                                <label>Ảnh sự kiện:</label>
                                <input type="file" name="file_image[]" id="file_image" class="form-control" multiple>
                                <span class="text-danger">{{ $errors->first('file_image') }}</span>
                            </div>
                            <div class="show-image" id="image-event">

                            </div>
                        </div>
                        
                        <div class="col-md-5" style="margin-left: 20px;">
                            <div class="$errors->has('name_document') ? 'has-error' : '' }}">
                                <input type="text" name="name_document" placeholder="Nhập tên tài liệu..." value="{{old('name_document')}}">
                                <span class="text-danger">{{$errors->first('name_document')}}</span>
                            </div>

                            <div class="{{ $errors->has('file_document') ? ' has-error' : ''}}">
                                <label>Tài liệu sự kiện:</label>
                                <input type="file" name="file_document[]" id="file_document" class="form-control" multiple>
                                <span class="text-danger">{{ $errors->first('file_document') }}</span>
                            </div>
                            <div class="show-document" id="document-event">

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description:</label> 
                        <textarea class="form-control description" rows="5" id="description" name="description" placeholder="Enter description..." value="{{old('description')}}"></textarea>
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>
                </div>

                <div class="add-ticket">
                    <h2>Tạo vé sự kiện:</h2>
                    <!-- <button type="button" class="btn btn-primary" data-toggle="collapse">
                        <span class="glyphicon glyphicon-collapse-down"></span>Tạo vé
                    </button> -->
                    <div class="tickets form-group" id="add-ticket">
                        <div class="name_type_ticket {{ $errors->has('name_type_event') ? 'has-error' : '' }}">
                            <label>Tên vé:</label>
                            <input type="text" name="name_type_ticket" placeholder="Nhập tên vé..." value="{{old('name_type_ticket')}}" class="form-control">
                            <span class="text-danger">{{ $errors->first('name_type_ticket') }}</span>
                        </div>

                        <div class="row number">
                            <div class="col-md-6 {{ $errors->has('
                                number') ? 'has-error' : '' }}">
                                <label>Giá vé:</label>
                                <input type="number" name="price" placeholder="Nhập giá vé..." value="{{old('price')}}" class="form-control">
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            </div>
                            <div class="col-md-6 {{ $errors->has('quantity') ? 'has-error' : '' }}">
                                <label>Số lượng:</label>
                                <input type="number" name="quantity" placeholder="Nhập số lượng vé" value="{{old('quantity')}}" class="form-control">
                                <span class="text-danger">{{ $errors->first('quantity') }}</span>
                            </div>
                        </div>

                        <div class="description">
                            <label>Thông tin chi tiết:</label>
                            <textarea name="description" rows="3" placeholder="Nhập chi tiết về loại vé..." value="{{old('description')}}" class="form-control"></textarea>
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 form-group" style="margin-left: 30px;">
                    <input type="submit" class="btn btn-success" value="Create Event" />
                </div>
            </div>
        </form>
    </div> 
    <script>
        jQuery(document).ready(function () {

            jQuery('#date_start').datetimepicker();
        });
    </script> 

    <script>
        jQuery(document).ready(function () {

            jQuery('#date_end').datetimepicker();
        });
    </script>  

    <script>
        $(document).ready(
            function() {
                $('#type_event1').multiselect({
                    enableFiltering:true
            });
        });
    </script> 

    <script>
        $(document).ready(
            function() {
                $('#company_id').multiselect({
                    enableFiltering:true
            });
        });
    </script>
@stop