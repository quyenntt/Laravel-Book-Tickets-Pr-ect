@extends('layouts.admin.admin')

@section('content')
<h1 style="color: #0099CC; text-align: center; margin-top: 10px;">Tickets Management</h1>
@if (session('create_ticket'))
<div class="alert alert-success">
    {{ session('create_ticket') }}
</div>
@endif
@if (session('update_ticket'))
<div class="alert alert-success">
    {{ session('update_ticket') }}
</div>
@endif
@if(Session::has('deleted_ticket'))
<p class="bg-danger">{{session('deleted_ticket')}}</p>
@endif
<div class="container">
    <form action="{{route('admin.tickets.store')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row col-md-4 form-group {{ $errors->has('name_type_ticket') ? 'has-error' : '' }} ">
            <label>Name Event:</label>
            <select class="form-control" id="event_id" name="event_id" >
                <option value="" selected="true">--Choose Event--</option>
                @foreach ($events as $event)
                    <option value="{{$event->id}}">{{$event->title_event}}</option>
                @endforeach   
            </select>                
            <span class="text-danger">{{ $errors->first('event_id') }}</span><br>

            <label>Name Type Ticket:</label>
            <input type="text" id="name_type_ticket" name="name_type_ticket" class="form-control" placeholder="Enter name type ticket..." value="{{ old('name_type_ticket') }}">
            <span class="text-danger">{{ $errors->first('name_type_ticket') }}</span><br>
               
            <label>Price:</label>
            <input type="number" id="price" name="price" class="form-control" placeholder="Enter price..." value="{{ old('price') }}">
            <span class="text-danger">{{ $errors->first('price') }}</span> 

            <label>Quantity:</label>
            <input type="number" name="quantity" class="form-control" placeholder="Enter quantity..." value="{{old('quantity')}}">
            <span class="text-danger">{{$errors->first('price')}}</span>

            <label>Description:</label>
            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Enter description..." value="{{old('description')}}"></textarea>
            <span class="text-danger">{{ $errors->first('description') }}</span>
                
            <div class="form-group" style="margin-top: 10px;">
                <input type="submit" class="btn btn-success" value="Create" />
            </div>
        </div>

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
                        <th colspan="2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tickets as $ticket)
                    <tr>
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->event_tickets->title_event}}</td>
                        <td>{{$ticket->name_type_ticket}}</td>  
                        <td>{{$ticket->price}}</td>
                        <td>{{$ticket->quantity}}</td>
                        <td>{{$ticket->description}}</td>
                        <td>{{$ticket->created_at->diffForhumans()}}</td>
                        <td>{{$ticket->updated_at->diffForhumans()}}</td>
                        <td>
                            <a href="{{ url('admin/tickets/'.$ticket->id.'/edit') }}">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.tickets.destroy',$ticket->id) }}" method="POST">
                               <input type="hidden" name_type_ticket="_method" value="DELETE">
                                    {{ csrf_field() }}
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-lg-6 col-sm-offset-5">
                    {{ $tickets->render() }}
                </div>
            </div>
        </div>
    </form>
</div>
@endsection