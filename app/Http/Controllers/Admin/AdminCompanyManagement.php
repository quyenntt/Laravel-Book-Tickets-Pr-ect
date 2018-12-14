<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Company;
use App\AttachedFile;
use App\Event;
use App\CompanyEvent;

class AdminCompanyManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $companies = Company::where('is_delete',0)->orderBy('created_at', 'asc')->paginate(10);
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
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
            'name_company'  => 'required|min:2',
            'name_file'     => 'required',
            'attached_file' => 'required|image|max:5120',
            'address'       => 'required|min:5',
            'phone'         => 'required|min:10|max:15',
            'email'         => 'required',
            ], [
            'name_company.required' => 'Vui lòng nhập tên công ty.',
            'name_company.min'      => 'Tên công ty phải lớn hơn 2 kí tự.',
            'name_file.required'    => 'Vui lòng nhập tên file.',
            'attached_file.required'=> 'Vui lòng chọn tệp đính kèm.',
            'attached_file.max'     => 'Dung lượng file nhỏ hơn 5 MB.',
            'address.required'      => 'Vui lòng nhập địa chỉ.',
            'address.min'           => 'Địa chỉ phải lớn hơn 5 kí tự.',
            'phone.required'        => 'Vui lòng nhập số điện thoại',
            'phone.min'             => 'Số điện thoại phải lớn hơn hoặc bằng 10 kí tự.',
            'phone.max'             => 'Số điện thoại phải nhỏ hơn hoặc bằng 16 kí tự',
        ]);

        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['name_company'] = $request->get('name_company');
            $input['address'] = $request->get('address');
            $input['phone']   = $request->get('phone');
            $input['email']   = $request->get('email');
            $input['is_delete'] = 0;
            $company = Company::create($input);
            if ($company) {  
                if($request->hasFile('attached_file')){ 
                    $files = $request->file('attached_file');
                    if($files){
                        foreach($files as $file){
                            if (isset($file)) {
                                $year       = date('Y');
                                $month      = date('m');
                                $day        = date('d');
                                $company_id    = $company->id;

                                $sub_folder = 'companies'.'/'. $year . '/' . $month . '/' . $day . '/' . $company_id . '/';
                                $upload_url = 'images/' . $sub_folder;

                                if (!File::exists(public_path() . '/' . $upload_url)) {
                                    File::makeDirectory(public_path() . '/' . $upload_url, 0777, true);
                                }
                                $allowedfileExtension=['gif','jpg','png','jpeg'];
                                $extension = $file->getClientOriginalExtension();
                                $check=in_array($extension,$allowedfileExtension);
                                if ($check) {
                                    foreach ($request->attached_file as $file){
                                        $name = time().$file->getClientOriginalName();
                                        $name_file = $request->get('name_file');
                                        // $file->move($upload_url, $name);
                                        $folder = $file->store($upload_url);
                                        $company_image = AttachedFile::create([
                                            'name_file' => $name_file,
                                            'attached_file' => $name,
                                            'describe'   => 'Not yes',
                                            'folder'        => $upload_url,
                                            'type_file'     => 0,
                                            'parent_object_id' => 1,
                                            'object_id'     => $company_id,
                                            'is_delete'     => 0,
                                        ]);
                                    }
                                }
                            }
                        }
                    }else{
                        $company_image = AttachedFile::create([
                            'name_file'     => 'Company Images',
                            'attached_file' => '//placehold.it/400x400',
                            'describe'   => 'Not yes',
                            'folder'        => 'http:',
                            'type_file'     => 0,
                            'parent_object_id' => 1,
                            'object_id'     => $company_id,
                            'is_delete'     => 0,
                        ]);
                    } 
                }
            }else{
                echo "Công ty không tồn tại.";
            }
            DB::commit();
            } catch (Exception $ex) {      
        }  
        return redirect('/admin/companies')->with('create_company', 'Tạo mới công ty thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $company = Company::findOrFail($id);
        // $companies = Company::where('is_delete',0)->orderBy('created_at', 'asc')->paginate(10);

        // return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $company_images = AttachedFile::where([['object_id', $id], ['parent_object_id', 1], ['is_delete', 0], ['type_file', 0]])->get();
        return view('admin.companies.edit', compact('company', 'company_images'));
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
        $company = Company::findOrFail($id);
        $company->update($request->all());
        DB::beginTransaction();
        try {
            if(isset($company->id)){
                $company_images = AttachedFile::select('id', 'is_delete')->where([['object_id', $id], ['parent_object_id', 1], ['is_delete', 0], ['type_file', 0]])->get();
                $files = $request->file('attached_file');

                if($company_images){
                    foreach($company_images as $group_image){
                        $image_id     = $group_image->id;
                        $delete_group_action = DB::table('attached_files')->where('id', '=', $image_id )->delete();
                    }
                }else{
                    $files = $request->file('attached_file');
                    if(count($files)>=1){
                        foreach ($request->attached_file as $file){
                            $year       = date('Y');
                            $month      = date('m');
                            $day        = date('d');
                            $company_id = $company->id;

                            $sub_folder = 'companies'.'/'. $year . '/' . $month . '/' . $day . '/' . $company_id . '/';
                            $upload_url = 'images/' . $sub_folder;

                            if (!File::exists(public_path() . '/' . $upload_url)) {
                                File::makeDirectory(public_path() . '/' . $upload_url, 0777, true);
                            }
                            $allowedfileExtension=['gif','jpg','png','jpeg'];
                            $extension = $file->getClientOriginalExtension();
                            $check=in_array($extension,$allowedfileExtension);
                            if ($check) {
                                $name = time().$file->getClientOriginalName();
                                $name_file = $request->get('name_file');
                                // $file->move($upload_url, $name);
                                $folder = $file->store($name);
                                $company_image = AttachedFile::create([
                                    'name_file' => $name_file,
                                    'attached_file' => $name,
                                    'describe'   => 'Not yes',
                                    'folder'        => $upload_url,
                                    'type_file'     => 0,
                                    'parent_object_id' => 1,
                                    'object_id'     => $company_id,
                                    'is_delete'     => 0,
                                ]);
                            }
                        }
                    }else{
                        echo "Không có ảnh nào được cập nhật.";
                    }
                }

                if (isset($files)) {
                    foreach ($request->attached_file as $file){
                        $year       = date('Y');
                        $month      = date('m');
                        $day        = date('d');
                        $company_id = $company->id;

                        $sub_folder = 'companies'.'/'. $year . '/' . $month . '/' . $day . '/' . $company_id . '/';
                        $upload_url = 'images/' . $sub_folder;

                        if (!File::exists(public_path() . '/' . $upload_url)) {
                            File::makeDirectory(public_path() . '/' . $upload_url, 0777, true);
                        }
                        $allowedfileExtension=['gif','jpg','png','jpeg'];
                        $extension = $file->getClientOriginalExtension();
                        $check=in_array($extension,$allowedfileExtension);
                        if ($check) {
                            $name = time().$file->getClientOriginalName();
                            $name_file = $request->get('name_file');
                            // $file->move($upload_url, $name);
                            $folder = $file->store($upload_url);
                            $company_image = AttachedFile::create([
                                'name_file' => $name_file,
                                'attached_file' => $name,
                                'describe'   => 'Not yes',
                                'folder'        => $upload_url,
                                'type_file'     => 0,
                                'parent_object_id' => 1,
                                'object_id'     => $company_id,
                                'is_delete'     => 0,
                            ]);
                        } 
                    }
                }else{
                    echo "Không có ảnh nào được cập nhật.";
                }
            }  
            DB::commit();
            } catch (Exception $ex) {  
        }
        return redirect('/admin/companies')->with('update_company', 'Cập nhật thông tin thành công!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company['is_delete'] = 1;
        $company->save();

        $company_events = CompanyEvent::where([['company_id', '=', $id], ['is_delete', '=', 0]])->get();

        if(count($company_events) >= 1){
            $is_delete = 1;
            $delete_company_event = CompanyEvent::where('company_id', '=', $id)->update(['is_delete' => $is_delete]);
        }

        $company_images = AttachedFile::where([['object_id', '=', $id], ['parent_object_id', '=', 1], ['type_file', 0], ['is_delete', '=', 0]])->get();

        if(count($company_images) >= 1){
            $is_delete = 1;
            $delete_company_image = AttachedFile::where([['object_id', '=', $id], ['parent_object_id', '=', 1], ['type_file', 0], ['is_delete', '=', 0]])->delete();
        }

        // foreach ($company_events as $key => $company_event) {
        //     $event_id = $company_event->event_id;
        //     $events = CompanyEvent::where([['event_id', '=', $event_id], ['is_delete', '=', 0]])->get();
        //     dd($events);
        //     if(count($events) == 0){
        //         $is_delete = 1;
        //         $delete_event = CompanyEvent::where('event_id', '=', $event_id)->update(['is_delete' => $is_delete]);
        //     }
        // }
        
        \Illuminate\Support\Facades\Session::flash('deleted_company', 'Thông tin công ty đã được xóa!');
        return redirect('/admin/companies');
    }

    public function getEvent($id){
        $event = new Company();
        $events = $event->getEvent($id);
        return view('admin.events.index', compact('$events'));
    }
}
