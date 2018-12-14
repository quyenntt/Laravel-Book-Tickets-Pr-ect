<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;
class Company extends Model
{
    use Notifiable;

    protected $fillable = [
        'name_company','address', 'phone', 'email', 'is_delete'
    ];

    public function attached_files() {
        return $this->hasMany('App\AttachedFile','object_id','id');
    }

    public function company_image() {
        return $this->attached_files()->where([['parent_object_id', 1], ['type_file',0], ['is_delete', 0]])->get()->last();
    }

    public function events(){
        return $this->hasMany('App\Event','company_id','id');
    }
    //Lấy sự kiện theo công ty
    public function getEventCompany($event){
        $comp_event = DB::select('select companies.name_company, companies.address,companies.phone, events.id, events.title_event, attached_files.attached_file, attached_files.folder from events join companies_events on companies_events.event_id = events.id join companies on companies.id = companies_events.company_id join attached_files on attached_files.object_id = companies.id and attached_files.id =( SELECT MAX(attached_files.id) FROM attached_files WHERE attached_files.object_id = EVENTS.id ) WHERE attached_files.parent_object_id = 1 AND EVENTS.is_delete = 0 AND events.id =?',[$event]);
        return $comp_event;
    }
    public function getEvent($id){
        $company_event = DB::select('select events.id, events.title_event, events.location, events.description, events.date_start, 
            events.date_end, events.status, events.created_at, events.updated_at 
            from companies
            join companies_events on companies_events.company_id = companies.id
            join events on events.id = companies_events.event_id
            where companies.id = ?', [$id]);
        return $company_event;
    }
}
