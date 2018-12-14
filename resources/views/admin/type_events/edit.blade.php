@extends('layouts.admin.admin')

@section('content')
<h1 style="color: #0099CC; text-align: center; margin-top: 10px;">Edit Type Event</h1>
<div class="container">
    <form action="{{route('admin.type_events.update', $type_event->id)}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        <div class="row">
            <div class="form-group"  {{ $errors->has('name_type_event') ? 'has-error' : '' }} ">           
                <label>Name Type:</label>
                <input type="text" id="name_type_event" name="name_type_event" class="form-control" placeholder="Enter name_type_event" value="{{ $type_event->name_type_event}}" required>
                <span class="text-danger">{{ $errors->first('name_type_event') }}</span>   

                <label for="description" style="margin-top: 20px;">Description:</label>
                <input type="text" id="description" name="description" class="form-control" placeholder="Enter description" value="{{$type_event->description}}" required>
                <span class="text-danger">{{ $errors->first('description') }}</span> 

                <div class="form-group" style="margin-top: 10px;">
                    <input type="submit" class="btn btn-success" value="Edit" />
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
