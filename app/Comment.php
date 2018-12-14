<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DB;
class Comment extends Model
{
    use Notifiable;
    protected $table = 'comments';

    protected $fillable = [
        'user_id', 'event_id', 'parent_id', 'content', 'is_delete'
    ];

    public function user() {
        $a = $this->belongsTo('App\User', 'user_id', 'id');
        return $a;
    }
    public function user_comment(){
        $user1 = DB::select('select users.id, users.username from comments join users on users.id = comments.user_id');
        return $user1;
        }

    public function event() {
        return $this->belongsTo('App\Event','event_id', 'id');
    }

    public function children() {
        return $this->hasMany('App\Comment', 'parent_id', 'id', ['is_delete', '=', '0']);
    }
}
