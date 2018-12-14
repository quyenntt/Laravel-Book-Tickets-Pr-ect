<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\Event;
use Input,File;
use App\Contact;
use App\Ticket;
use App\User;
use App\Comment;
use App\TypeEvent;
use App\AttachedFile;
use App\Like;
class EventController extends Controller
{
    //Hàm hiển thị sự kiện theo công ty
    public function getEvent($evc){
        $type_event = TypeEvent::select('id','name_type_event')->get();
        $company = Company::all();
        $event = new Event();
        $event_company = $event->getEventToCompany($evc);
        return view('client.page.event',compact('company','event_company','type_event'));
    }
    //Hàm hiển thị chi tiết của sự kiện
    public function getDetailevent($evd){
        $ev_detail = Event::where('id',$evd)->first();
        $type_ticket = Ticket::select('id','name_type_ticket','price','quantity')->where('event_id',$ev_detail->id)->get();
        // Hiển thị thông tin chi tiết của từng sự kiện
        $detail = new Event();
        $event_details = $detail->getEventDetail($evd);
        // Hiển thị những hình ảnh liên quan đến sự kiện
        $attached_file = new AttachedFile();
        $imageEventDetail = $attached_file->getImageEachEvent($evd);
        //hiển thị những công ty liên quan đến sự kiện đó
        $comp = new Company();
        $companies = $comp->getEventCompany($evd);
         // Hiển thị ra dữ liệu của sự kiện nổi bật
        $event = new Event();
        $eventall = $event->image_event();
        //hiển thị like
        $like  = new Like();
        $count = $like->LikeEvent($evd);
        //hiển thị comments
        $comment = new Comment();
        $user = $comment->user_comment();
        $comments = DB::table('comments')->where([['event_id', $ev_detail->id], ['parent_id', 0], ['is_delete', 0]])->orderBy('created_at', 'asc')->get();
        return view('client.page.event_detail', compact('event_details', 'companies','type_ticket','imageEventDetail','eventall','comments','user','count'));
    }
    //Hàm lưu thông tin đăng kí user
    public function postRegister(Request $request){
        $rules= [
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:20',
            'remember_token'=>'required|same:password',
        ];
        $this->validate($request, $rules);
        $user = new User();
        $user->email = $request->email;
        $user->password = $request->password;
        $user->remember_token = $request->remember_token;
        $user->is_delete = 0;
        $user->save();
        return redirect()->back()->with(['flash_level' => 'success','flash_message' =>'Thêm bài viết thành công']);
    }
    //Hiển thị tất cả các sự kiện
    public function getAllEvents(){
        $type_event = TypeEvent::select('id','name_type_event')->get();
        $company = Company::all();
        $event = new Event();
        $allevent = $event->getAllEvent();
        $is_search = 0;
        return view('client.page.allevent',compact('type_event','company','allevent','is_search'));
    }
    //Full search text cho Client
    public function search() {
        $allevent = Event::search($_GET['search_text'])->paginate(3);
        $allevent->setPath('search?search_text='.$_GET['search_text']);
        $search_text = $_GET['search_text'];
        $is_search = 1;
        $type_event = TypeEvent::select('id','name_type_event')->get();
        $company = Company::all();
        return view('client.page.allevent', compact('allevent','company','type_event','is_search'));
    }
    //like function
    public function like(Request $request ,$id_event){
        $event_id = $request->event_id;
        $user_id  = $request->id_user;
        $like  = new Like();
        $existLike = $like->LikeExist($id_event,Auth::user()->id);
        $dem = count($existLike);
        if($request->ajax()){
            if($dem==0){
                $likeEvent  = new Like();
                $likeEvent->user_id     = $user_id;
                $likeEvent->type_object = 1;
                $likeEvent->object_id   = $event_id;
                $likeEvent->save();
                $show = new Like();
                $showCountLike = $show->LikeEvent($id_event);
                $Amountdemlike  = $showCountLike[0]->CountLike;
            }
            else
            {
                $findId = Like::where([['user_id', '=', $user_id],['type_object', '=',1], ['object_id', '=', $event_id] ,['is_delete', '=', 0]])->get()->first();
                $idLike      = $findId->id;
                $disLike = Like::findOrFail($idLike);
                $disLike->delete();
                $show = new Like();
                $showCountLike = $show->LikeEvent($id_event);
                $Amountdemlike  = $showCountLike[0]->CountLike;

            }
            return response()->json(['event_id'=>$event_id,'dem'=>$dem,'Amountdemlike'=>$Amountdemlike,'user_id'=>$user_id]);  
         } 
    }
}
