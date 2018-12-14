<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;

class Event extends Model
{
    use Notifiable;

    use FullTextSearch;

    protected $table = 'events';

    protected $fillable = ['id','title_event', 'location', 'description','date_start', 'date_end', 'status', 'type_event_id', 'company_id',
    ];

    protected $searchable = [
        'title_event', 'location', 'description' 
    ];
    
    public function type_events(){
        return $this->belongsTo('App\TypeEvent','type_id', 'id');
    }
    public function companies(){
        return $this->belongsTo('App\Company','company_id', 'id');
    }
    public function tickets(){
        return $this->hasMany('App\Ticket','event_id', 'id');
    }

    public function is_ticket($event){
        $ev =  $this->where([['id', $event], ['is_delete', 0]])->get()->first();
        return $ev;
    }
    public function type_ticket($id){
        $type = $this->tickets()->where('is_delete',0)->get()->first();
        return $type;
    }

    public function attached_files() {
        return $this->hasMany('App\AttachedFile','object_id','id');
    }

    public function event_image() {
        return $this->attached_files()->where([['parent_object_id', 2], ['type_file',0], ['is_delete', 0]])->get()->last();
    }

    public function event_document() {
        return $this->attached_files()->where([['parent_object_id', 2], ['type_file',1], ['is_delete', 0]])->get()->last();
    }
    
    public function thumbnail($id) {
        $a =  $this->attached_files()->where([['object_id',$id],['parent_object_id', 2], ['type_file',0], ['is_delete', 0]])->get()->first();
        return $a;
    }

    //Lấy tất cả các comment của event
    public function getComments($id){
        $comments = DB::select('select events.id, comments.id, comments.event_id, comments.parent_id, comments.content, comments.user_id, comments.created_at, users.username, users.email, attached_files.attached_file, attached_files.folder,attached_files.parent_object_id, attached_files.object_id from events
            join comments on events.id = comments.event_id and comments.parent_id = comments.id
            join users on comments.user_id = users.id
            join attached_files on users.id =  attached_files.object_id and attached_files.parent_object_id = 3
            where events.is_delete = 0 and events.id = ?',[$id]);
        return $comments;
    }

    //Lấy hình ảnh và những thông tin của sự kiện lưu trong trang chủ
    public static function image_event(){
        $img = DB::select('select events.id, events.title_event, events.location,events.description, attached_files.attached_file, events.date_start, attached_files.folder from events join attached_files on events.id = attached_files.object_id and attached_files.id = (SELECT MAX(attached_files.id) FROM attached_files WHERE attached_files.object_id = events.id ) where attached_files.parent_object_id = 2 and attached_files.type_file = 0 and events.is_delete = 0 limit 6');
        return $img;
    }
    //Hiển thị những sự kiện miễn phí
    public static function event_free(){
        $free_event = DB::select('select events.date_start, events.date_end,events.id, events.title_event, attached_files.folder, attached_files.attached_file, tickets.price from events join tickets on events.id = tickets.event_id join attached_files on attached_files.object_id = events.id and attached_files.id = (select MAX(attached_files.id) from attached_files where attached_files.object_id = events.id ) where attached_files.parent_object_id =2 and attached_files.type_file = 0 and events.is_delete = 0 and tickets.price =0 limit 4');
        return $free_event;
    }
    //Hiển thị những sự kiện phải trả tiền vé
    public function paid_event(){
        $paid_event = DB::select('select events.date_start, events.date_end,events.id, events.title_event, attached_files.folder, attached_files.attached_file, tickets.price from events join tickets on events.id = tickets.event_id and tickets.id = (select MAX(tickets.id) from tickets where tickets.event_id = events.id) join attached_files on attached_files.object_id = events.id and attached_files.id = (select max(attached_files.id) from attached_files where attached_files.object_id = events.id ) where attached_files.parent_object_id = 2 and attached_files.type_file = 0 and events.is_delete = 0 and tickets.price <>0 limit 4');
        return $paid_event;
    }
    //Hiển thị các sự kiện tương ứng với từng loại sự kiện
    public function getTypeEvent($id){
        $type_event = DB::select('select title_event, EVENTS.description, EVENTS.location, EVENTS.id, EVENTS.date_start, type_events.name_type_event, attached_files.attached_file, attached_files.folder FROM EVENTS JOIN type_event_events on type_event_events.event_id = events.id JOIN type_events ON type_events.id = type_event_events.type_id JOIN attached_files ON attached_files.object_id = EVENTS.id AND attached_files.id =( SELECT MAX(attached_files.id) FROM attached_files WHERE attached_files.object_id = EVENTS.id ) WHERE attached_files.parent_object_id = 2 and attached_files.type_file = 0 AND EVENTS.is_delete = 0 AND type_events.id = ?',[$id]);
        return $type_event;
    }
    //Hiển thị những sự kiện tương ứng với từng công ty
    public function getEventToCompany($id){

        $event_com = DB::select('select EVENTS .id, EVENTS.title_event, EVENTS.date_start, EVENTS.location, EVENTS.description, EVENTS.date_end, EVENTS.is_delete, companies.address, attached_files.attached_file, attached_files.folder FROM EVENTS JOIN companies_events ON companies_events.event_id = EVENTS.id JOIN companies ON companies.id = companies_events.company_id JOIN attached_files ON attached_files.object_id = EVENTS.id AND attached_files.id =( SELECT MAX(attached_files.id) FROM attached_files WHERE attached_files.object_id = EVENTS.id ) WHERE attached_files.parent_object_id = 2 and attached_files.type_file = 0 AND EVENTS.is_delete = 0 AND companies.id = ?',[$id]);
        // var_dump($event_com);
        return $event_com;
    }
    //hiển thị thông tin chi tiết của từng sự kiện
    public function getEventDetail($id_event){
        $event_detail = DB::select('select events.id,events.title_event, events.description,events.location,events.date_start,events.date_end, attached_files.folder,attached_files.attached_file from events join attached_files on attached_files.object_id = events.id and attached_files.id = (select max(attached_files.id) from attached_files where attached_files.object_id = events.id ) where attached_files.parent_object_id =2 and attached_files.type_file = 0 and events.is_delete=0 and events.id = ?',[$id_event])[0];
        return $event_detail;
    }

    //hiển thị tất cả các sự kiện
    public function getAllEvent(){
        $allevent = DB::select('select events.id,events.title_event, events.location, events.description, events.date_start, attached_files.attached_file, attached_files.folder from events left join attached_files on attached_files.object_id = events.id and attached_files.id = (select max(attached_files.id) from attached_files where attached_files.object_id = events.id) where attached_files.parent_object_id =2 and attached_files.type_file = 0
            ');
        return $allevent;
    }

}
