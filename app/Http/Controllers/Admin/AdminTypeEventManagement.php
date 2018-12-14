<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\TypeEvent;
use App\TypeEvent_Event;

class AdminTypeEventManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_events = TypeEvent::where('is_delete',0)->orderBy('created_at', 'asc')->get();
        return view('admin.type_events.index', compact('type_events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.type_events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name_type_event' => 'required|min:2',
            'description' => 'required|min:3',
            ], [
            'name_type_event.required' => 'Name action is required.',
            'name_type_event.min'      => 'Name action is very short.',
            'description.required' => 'Description is required.',
            'description.min'      => 'Description is very short.'
        ]);
             
        $input = $request->all();
        $input['is_delete'] = 0;
        TypeEvent::create($input);
        return redirect('/admin/type_events')->with('create_type_event', 'Tạo mới thành công!');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type_event = TypeEvent::findOrFail($id);
        return view('admin.type_events.edit', compact('type_event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $type_event = TypeEvent::findOrFail($id);
       $type_event->update($request->all());
      return redirect('/admin/type_events')->with('update_type_event', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type_event = TypeEvent::findOrFail($id);
        $type_event['is_delete'] = 1;
        $type_event->save();
        $is_delete = 1;
        $deleted_type_event = TypeEvent_Event::where('type_event_id', '=', $id)->update(['is_delete' => $is_delete]);
        \Illuminate\Support\Facades\Session::flash('deleted_type_event', 'Loại sự kiện đã được xóa!');
        return redirect('/admin/type_events');
    }

    public function getEvent($id){
        $getevent = new TypeEvent();
        $events = $getevent->getEvent($id);
        return view('admin.events.index', compact('$events'));
    }
}
