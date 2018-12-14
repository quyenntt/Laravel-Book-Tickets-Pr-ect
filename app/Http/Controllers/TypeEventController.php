<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeEvent;
use App\Company;
use App\Event;
use DB;
class TypeEventController extends Controller
{
    //Hiển thị các sự kiện theo loại sự kiện
    public function getTypeEvent($type){
    	$company = Company::all();
    	   // Hiển thị loại event 
        $type_event = TypeEvent::select('id','name_type_event')->get();
    	$types = TypeEvent::find($type);
    	$event = Event::where('type_event_id',$type);
        $event_type = new Event();
        $get_event = $event_type->getTypeEvent($type);
    	return view('client.page.event_demo',compact('company','get_event','type_event'));
    }
}
