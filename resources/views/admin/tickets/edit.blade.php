@extends('layouts.admin.admin')

@section('content')
<h1 style="color: #0099CC; text-align: center; margin-top: 10px;">Edit Tickets</h1>

<div class="container">
    <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">
        <div class="row col-md-4 form-group">
            <div class="{{ $errors->has('name_type_ticket') ? 'has-error' : '' }} ">
                <label>Name Event:</label>
                <select class="form-control" id="event_id" name="event_id" required>
                    @foreach ($events as $event)
                        <option value="{{$event->id}}" @if($event->id == $ticket->event_id) selected="selected" @endif>{{$event->title_event}}</option>
                    @endforeach   
                </select>                
                <span class="text-danger">{{ $errors->first('event_id') }}</span><br>
            </div>

            <label>Name Type Ticket:</label>
            <input type="text" id="name_type_ticket" name="name_type_ticket" class="form-control" placeholder="Enter name type ticket..." value="{{$ticket->name_type_ticket }}" required>
            <span class="text-danger">{{ $errors->first('name_type_ticket') }}</span><br>
               
            <label>Price:</label>
            <input type="number" id="price" name="price" class="form-control" placeholder="Enter price..." value="{{$ticket->price}}" required>
            <span class="text-danger">{{ $errors->first('price') }}</span> 

            <label>Quantity:</label>
            <input type="number" name="quantity" class="form-control" placeholder="Enter quantity..." value="{{$ticket->quantity}}" required>
            <span class="text-danger">{{$errors->first('price')}}</span>

            <label>Description:</label>
            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Enter description..." required>{{$ticket->description}}</textarea>
            <span class="text-danger">{{ $errors->first('description') }}</span>
                
            <div class="form-group" style="margin-top: 10px;">
                <input type="submit" class="btn btn-success" value="Edit Ticket" />
            </div>
        </div>
    </form>
        <div class="row col-md-8 form-group" style="margin-left: 10px;">
            <table class="table"> 
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name Event</th>
                        <th>Name Ticket</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>
                </thead>

                <tbody>
                    @if($event)
                    <tr>
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->events->title_event}}</td>
                        <td>{{$ticket->name_type_ticket}}</td>  
                        <td>{{$ticket->price}}</td>
                        <td>{{$ticket->quantity}}</td>
                        <td>{{$ticket->description}}</td>
                        <td>{{$ticket->created_at->diffForhumans()}}</td>
                        <td>{{$ticket->updated_at->diffForhumans()}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
</div>
@endsection