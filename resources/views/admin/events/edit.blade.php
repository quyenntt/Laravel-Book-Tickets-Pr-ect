@extends('layouts.admin.admin')

@section('content')
<h1 style="color: #0099CC; text-align: center; margin:20px;">Cập nhật thông tin sự kiện</h1>

<div class="container">
    <form action="{{ route('admin.events.update', $event->id) }}" method="post" enctype='multipart/form-data'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT"> 

        <div class="row form-group">
            <div class="col-md-5 {{ $errors->has('title_event') ? 'has-error' : '' }}">
                <label>Name Event:</label>
                <input type="text" id="title_event" name="title_event" class="form-control" placeholder="Enter name event..." value="{{$event->title_event}}" required>
                <span class="text-danger">{{ $errors->first('title_event') }}</span>
            </div> 
            <div class="col-md-5 {{ $errors->has('location') ? 'has-error' : '' }}">
                <label>Location:</label>
                <input type="text" id="location" name="location" class="form-control" placeholder="Enter location..." value="{{$event->location}}" required>
                <span class="text-danger">{{ $errors->first('location') }}</span>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-5 {{$errors->has('date_start') ? 'has-error' : ''}}">
                <label>Date Start:</label>
                <input type="hidden" id="timezone" name="timezone" value="+07:00">
                <input type="datetime-local" min="2018-06-25T05:00:00" max="2020-01-01T01:00:00"" name="date_start" id="date_start" value="{{$event->date_start}}" required>
                {{$event->date_start}}
                <span class="text-danger">{{ $errors->first('date_start') }}</span>
            </div>
            <div class="col-md-5 {{$errors->has('date_end') ? 'has-error' : ''}}">
                <label>Date End:</label>
                <input type="hidden" id="timezone" name="timezone" value="+07:00">
                <input type="datetime-local" min="2018-06-25T05:00:00" max="2020-02-01T02:00:00" name="date_end" id="date_end" value="{{$event->date_end}}" required>
                {{$event->date_end}}
                <span class="text-danger">{{ $errors->first('date_end') }}</span>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-5 {{$errors->has('type_event_id') ? 'has-error' : ''}}">
                <label>Type Event:</label>
                <select class="form-control" id="type_event_id" name="type_event_id" >
                    @foreach ($type_events as $type_event)
                        <option value="{{$type_event->id}}" @if($event->type_event_id == $type_event->id) selected="selected" @endif>
                            {{$type_event->name_type_event}}
                        </option>
                    @endforeach   
                </select>
                <span class="text-danger">{{ $errors->first('type_event_id') }}</span>
            </div>

            <div class="col-md-5 {{$errors->has('company_id') ?'has-error' :''}}">
                <label>Company:</label>
                <select class="form-control" id="company_id" name="company_id" >
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}" @if($event->company_id == $company->id) selected="selected" @endif>
                            {{$company->name_company}}
                        </option>
                    @endforeach   
                </select>
                <span class="text-danger">{{ $errors->first('company_id') }}</span>
            </div> 
        </div>
            
        <div class="row form-group">
            <div class="form-group " style="width:  200px">
                <img src="{{$event->event_image()? asset( $event->event_image()->folder.$event->event_image()->attached_file): 'http://placehold.it/400x400'}}" height="300" alt="" class="img-responsive img-rounded">
            </div><br>

            <div class="col-md-5 {{ $errors->has('file_image') ? 'has-error' : '' }}">
                <label>Event Image:</label>
                <input type="file" name="file_image" id="file_image" class="form-control" value="{{$event->event_image() ? $event->event_image()->attached_file:'UnImage'}}" required>
                <span class="text-danger">{{ $errors->first('file_image') }}</span>
            </div>
                
            <div class="col-md-5 {{ $errors->has('file_document') ? ' has-error' : ''}}">
                <label>Event Document:</label>
                <input type="file" name="file_document" id="file_document" class="form-control" value="{{$event->event_image() ? $event->event_image()->attached_file:'UnDocument'}}" required>
                <span class="text-danger">{{ $errors->first('file_document') }}</span>
            </div>
        </div>

        <div class="col-md-10 form-group">
            <label>Description:</label>
            <textarea class="form-control" rows="5" id="description" name="description" required>{{$event->description}}</textarea>
            <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
        </div>

        <div class="col-md-7 form-group" style="margin-left: 40px;">
            <input type="submit" class="btn btn-success" value="Save" />
        </div>
    </form>
</div>
@stop