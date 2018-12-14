<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'remember_token', 'role'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];
    protected $table = 'users';

    public function attached_files() {
        return $this->hasMany('App\AttachedFile','object_id','id');
    }

    public function user_avata() {
        return $this->attached_files()->where([['parent_object_id', 3], ['type_file',0], ['is_delete', 0]])->get()->last();
    }

    public function orders(){
        return $this->hasMany('App\Order','user_id','id');
    }
    public function user_action($id) {
        $user_action = DB::select('select users.id, users.username, user_actions.user_id, user_actions.action_id, actions.name_action from users
            join user_actions on users.id = user_actions.user_id
            join actions on user_actions.action_id = actions.id
            where users.id = ?',[$id]);
        return $user_action;
    }

    public function user_group($id) {
        $user_group = DB::select('select users.id, users.username, users_groups.user_id, users_groups.group_id, groups.name_group from users
            join users_groups on users.id = users_groups.user_id
            join groups on users_groups.group_id = groups.id
            where users.id = ?',[$id]);
        return $user_group;
    }

    public function type_users(){
        return $this->belongsTo('App\TypeUser','type_user_id', 'id');
    }

    //  public function user() {
    //     return $this->hasMany('App\User','id','user_id');
    // }
    public function is_Admin(){
        if($this->role ==0){
            return true;
        }
        else return false;
    }
}
