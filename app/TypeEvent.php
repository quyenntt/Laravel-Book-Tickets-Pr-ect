<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TypeEvent extends Model
{
    protected $table = 'type_events';
    protected $fillable = ['name_type_event', 'description'];

    public function events(){
    	return $this->hasMany('App\Event','type_id', 'id');
    }
}
