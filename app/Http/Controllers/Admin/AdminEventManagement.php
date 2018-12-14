<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Event;
use App\Company;
use App\TypeEvent;
use App\AttachedFile;
use App\TypeEvent_Event;

class AdminEventManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where([['is_delete',0], ['status', '=', 1]])->orderBy('created_at','asc')->paginate(10);

        return view('admin.events.index', compact('events'));
    }
    
    //Full Search Text cho Admin
    public function searchAdmin() {
        $events =Event::search($_GET['search_textadmin'])->paginate(10);
        $events->setPath('search?search_textadmin='.$_GET['search_textadmin']);
        $search_textadmin = $_GET['search_textadmin'];
        $is_search = 1;
        return view('admin.events.index', compact('events','is_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::where('is_delete',0)->orderBy('created_at', 'asc')->get();
        $type_events = TypeEvent::where('is_delete',0)->orderBy('created_at','asc')->get();
        return view('admin.events.create', compact('type_events', 'companies'));
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
            'title_event'       => 'required|min:3',
            'location'          => 'required|min:3',
            'description'       => 'required|min:3',
            'date_start'        => 'required',
            'date_end'          => 'required',
            'type_event_id'     => 'required',    
            'company_id'        => 'required',
            'name_image'        => 'required',
            'file_image'        => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'name_document'     => 'required',  
            'file_document'     => 'required|mimes:doc,docx,xls,xlsx|max:5120', 
            'name_type_ticket'  => 'required',
            'price'             => 'required',
            'quantity'          => 'required'
        ], [
            'title_event.required'  => 'Full name is required.',
            'title_event.min'       => 'Name Event is very short.',
            'location.required'     => 'Location is required.',
            'location.min'          => 'Location is very short.',
            'description.required'  => 'Description is required.',
            'description.min'       => 'Description is very short.',
            'date_start.required'   => 'Date start is required.',
            'date_end.required'     => 'Date end is required.',
            'type_event_id.required'=> 'Please choose type event!!',
            'company_id.required'   => 'Please choose company!!',
            'name_image.required'   => 'Nhập tên file.',
            'name_document.required'=> 'Nhập tên tài liệu',
            'name_type_ticket.required'=> 'Nhập tên vé.',
            'price.required'        => 'Nhập giá tiền.',
            'quantity.required'     => 'Nhập số lượng.',
            'file_image.required'   => 'Attached File is required.',
            'file_image.mimes'      => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'file_image.max'        => 'Dung lượng không quá 2MB',
            'file_document.required'=> 'Attached File is required',
            'file_document.mines'   => 'Chỉ chấp nhận với đuôi .doc .docx .xls .xlsx',
            'file_document.max'     => 'Dung lượng không quá 5MB',
        ]);

        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['title_event']   = $request->get('title_event');
            $input['location']      = $request->get('location');
            $input['description']   = $request->get('description');
            $input['date_start']    = $request->get('date_start');
            $input['date_end']      = $request->get('date_end');
            $input['status']        = 1;
            $input['is_delete']     = 0;
            $event = Event::create($input);

            if ($event != null) {
                $file_image = $request->file('file_image');
                $file_document = $request->file('file_document');
                if ($file_image) {
                    $this->validate($request, 
                    [
                        'file_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',  
                    ],          
                    [
                        'file_image.mimes'  => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif.',
                        'file_image.max'    => 'Dung lượng không quá 2MB.',
                    ]
                );
                    $year = date('Y');
                    $month = date('m');
                    $day = date('d');
                    
                    $sub_folder = 'events'.'/'. $year . '/' . $month . '/' . $day . '/';
                    $upload_url = 'images/' . $sub_folder;

                    if (!File::exists(public_path() . '/' . $upload_url)) {
                        File::makeDirectory(public_path() . '/' . $upload_url, 0777, true);
                    }
                    $name = time() . $file_image->getClientOriginalName();
                    $input['name_file']     = 'Event Image';
                    $input['attached_file'] = $name;
                    $input['description']   = 'Not yes';
                    $input['folder']        = $upload_url;
                    $input['type_file']     = 0;
                    $input['parent_object_id'] = 2;
                    $input['object_id']     = $event->id;
                    $input['is_delete']     = 0;
                    $file_image->move($upload_url, $name);
                    $attach_file = AttachedFile::create($input);
                } 

                if ($file_document) {
                    $this->validate($request, 
                    [
                        'file_document' => 'required|mimes:doc,docx,xls,xlsx|max:5120',  
                    ],          
                    [
                        'file_document.mimes'  => 'Chỉ chấp nhận với đuôi .doc .docx .xls .xlsx',
                        'file_document.max'    => 'Dung lượng không quá 5MB.',
                    ]
                );
                    $year   = date('Y');
                    $month  = date('m');
                    $day    = date('d');
                    
                    $sub_folder = 'events'.'/'. $year . '/' . $month . '/' . $day . '/';
                    $upload_url = 'documents/' . $sub_folder;

                    if (!File::exists(public_path() . '/' . $upload_url)) {
                        File::makeDirectory(public_path() . '/' . $upload_url, 0777, true);
                    }
                    $name = time() . $file_document->getClientOriginalName();
                    $input['name_file'] = 'Event Document';
                    $input['attached_file'] = $name;
                    $input['description'] = 'Not yes';
                    $input['folder'] = $upload_url;
                    $input['type_file'] = 1;
                    $input['parent_object_id'] = 2;
                    $input['object_id'] = $event->id;
                    $input['is_delete'] = 0;
                    $file_document->move($upload_url, $name);
                    $attach_file = AttachedFile::create($input);
                } 
                //Thêm nhiều công ty tổ chức sự kiện
                if($event){
                $companies = $request->input('company_id');
                    if ($companies){
                        foreach ($companies as $key => $company) {
                            $company_event = new CompanyEvent;
                            $company_event->event_id = $event->id;
                            $company_event->company_id = $company;
                            $company_event->is_delete = 0;
                            $company_event->save();
                        }
                    }
                }

                if($event){
                $type_events = $request->input('type_event_id');
                    if ($type_events){
                        foreach ($type_events as $key => $type_event) {
                            $type_event = new TypeEvent_Event;
                            $type_event->event_id = $event->id;
                            $type_event->type_id = $type_event;
                            $type_event->is_delete = 0;
                            $type_event->save();
                        }
                    } 
                }
            }
            DB::commit();
        } catch (Exception $ex) {
            
        }  
        return redirect('/admin/events')->with('create_event', 'You are success - create event!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $events = Event::where([['is_delete',0], ['status', '=', 0]])->orderBy('created_at','asc')->paginate(10);
        
        return view('admin.events.finishEvent', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies   = Company::where('is_delete',0)->orderBy('created_at', 'asc')->get();
        $type_events = TypeEvent::where('is_delete',0)->orderBy('created_at','asc')->get();
        $event       = Event::findOrFail($id);
        return view('admin.events.edit', compact('event','type_events', 'companies'));
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
        $event = Event::findOrFail($id);
        $event->update($request->all());
        DB::beginTransaction();
        try{
            $file_image = $request->get('file_image');
            if ($event != null) {
                $file_image = $request->file('file_image');
                $file_document = $request->file('file_document');
                if ($file_image) {
                    $this->validate($request, 
                    [
                        'file_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',  
                    ],          
                    [
                        'file_image.mimes'  => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif.',
                        'file_image.max'    => 'Dung lượng không quá 2MB.',
                    ]
                );
                    $year = date('Y');
                    $month = date('m');
                    $day = date('d');
                    
                    $sub_folder = 'events'.'/'. $year . '/' . $month . '/' . $day . '/';
                    $upload_url = 'images/' . $sub_folder;

                    if (!File::exists(public_path() . '/' . $upload_url)) {
                        File::makeDirectory(public_path() . '/' . $upload_url, 0777, true);
                    }
                    $name = time() . $file_image->getClientOriginalName();
                    $input['name_file']     = 'Event Image';
                    $input['attached_file'] = $name;
                    $input['description']   = 'Not yes';
                    $input['folder']        = $upload_url;
                    $input['type_file']     = 0;
                    $input['parent_object_id'] = 2;
                    $input['object_id']     = $event->id;
                    $input['is_delete']     = 0;
                    $file_image->move($upload_url, $name);
                    $attach_file = AttachedFile::create($input);
                } 

                if ($file_document) {
                    $this->validate($request, 
                    [
                        'file_document' => 'required|mimes:doc,docx,xls,xlsx|max:5120',  
                    ],          
                    [
                        'file_document.mimes'  => 'Chỉ chấp nhận với đuôi .doc .docx .xls .xlsx',
                        'file_document.max'    => 'Dung lượng không quá 5MB.',
                    ]
                );
                    $year   = date('Y');
                    $month  = date('m');
                    $day    = date('d');
                    
                    $sub_folder = 'events'.'/'. $year . '/' . $month . '/' . $day . '/';
                    $upload_url = 'documents/' . $sub_folder;

                    if (!File::exists(public_path() . '/' . $upload_url)) {
                        File::makeDirectory(public_path() . '/' . $upload_url, 0777, true);
                    }
                    $name = time() . $file_document->getClientOriginalName();
                    $input['name_file'] = 'Event Document';
                    $input['attached_file'] = $name;
                    $input['description'] = 'Not yes';
                    $input['folder'] = $upload_url;
                    $input['type_file'] = 1;
                    $input['parent_object_id'] = 2;
                    $input['object_id'] = $event->id;
                    $input['is_delete'] = 0;
                    $file_document->move($upload_url, $name);
                    $attach_file = AttachedFile::create($input);
                }  
            }
            DB::commit();
        } catch (Exception $ex) {
            
        }  
        return redirect('/admin/events')->with('update_event', 'You are success - update event!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event['is_delete'] = 1;
        $event->save();
        $is_delete = 1;
        $delete_event_company = CompanyEvent::where('event_id', '=', $id)->update(['is_delete' => $is_delete]);
        $delete_type_event = TypeEvent_Event::where('event_id', '=', $id)->update(['is_delete' => $is_delete]);
        \Illuminate\Support\Facades\Session::flash('deleted_event', 'The event has been deleted');
        return redirect('/admin/events');
    }

    public function getCompany($id){
        $company = new Event();
        $companies = $company->getCompany($id);
        return view('admin.companies.index', compact('companies'));
    }

    public function getTypeEvents($id){
        $type_event = new Event();
        $type_events = $type_event->getTypeEvents($id);
        return view('admin.type_events.index', compact('type_events'));
    }
}
