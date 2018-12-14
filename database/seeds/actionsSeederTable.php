<?php

use Illuminate\Database\Seeder;

class actionsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('actions')->get()->count() == 0){
            $actions = [

                  [
                    'name_action' => 'Companies',
                    'link_action' => 'companies/',
                    'is_public'   => '1',
                    'description' => 'Companies 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'See All Companies',
                    'link_action' => 'admin/companies',
                    'is_public'   => '1',
                    'description' => 'See All Companies 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Create Companies',
                    'link_action' => 'admin/companies/create',
                    'is_public'   => '1',
                    'description' => 'Create Companies 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Type Events',
                    'link_action' => 'Type Events/',
                    'is_public'   => '1',
                    'description' => 'Type Events 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'See All Type Events',
                    'link_action' => 'admin/type_events',
                    'is_public'   => '1',
                    'description' => 'See All Type Events 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Event',
                    'link_action' => 'Event/',
                    'is_public'   => '1',
                    'is_delete'   => '0',
                    'description' => 'Event 1',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'See All Event',
                    'link_action' => 'admin/events',
                    'is_public'   => '1',
                    'is_delete'   => '0',
                    'description' => 'See All Event 1',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Create Event',
                    'link_action' => 'admin/events/create',
                    'is_public'   => '1',
                    'description' => 'Create Event 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Tickets',
                    'link_action' => 'Tickets/',
                    'is_public'   => '1',
                    'description' => 'Tickets 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Comment',
                    'link_action' => 'comments/',
                    'is_public'   => '1',
                    'description' => 'Comment 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'See All Comment',
                    'link_action' => 'admin/comments',
                    'is_public'   => '1',
                    'description' => 'See All Comment 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Oder',
                    'link_action' => 'orders/',
                    'is_public'   => '1',
                    'description' => 'Oder 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'See All Oder',
                    'link_action' => 'admin/orders',
                    'is_public'   => '1',
                    'description' => 'See All Oder 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Oder Finish',
                    'link_action' => 'admin/orders',
                    'is_public'   => '1',
                    'description' => 'Oder Finish 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'See Unfinish Oder',
                    'link_action' => 'admin/orders',
                    'is_public'   => '1',
                    'description' => 'See Unfinish Oder 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Action',
                    'link_action' => 'actions/',
                    'is_public'   => '1',
                    'description' => 'Action 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'See All Action',
                    'link_action' => 'admin/actions',
                    'is_public'   => '1',
                    'description' => 'See All Action 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Create Action',
                    'link_action' => 'admin/actions/create',
                    'is_public'   => '1',
                    'description' => 'Create Action 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'User',
                    'link_action' => 'users/',
                    'is_public'   => '1',
                    'description' => 'User 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'See All User',
                    'link_action' => 'admin/users',
                    'is_public'   => '1',
                    'description' => 'See All User 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Create User',
                    'link_action' => 'admin/users/create',
                    'is_public'   => '1',
                    'description' => 'Create User 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Group',
                    'link_action' => 'groups/',
                    'is_public'   => '1',
                    'description' => 'Group 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'See All Group',
                    'link_action' => 'admin/groups',
                    'is_public'   => '1',
                    'description' => 'See All Group 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Edit Group',
                    'link_action' => 'admin/groups/edit',
                    'is_public'   => '1',
                    'description' => '',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Menu',
                    'link_action' => 'menus/',
                    'is_public'   => '1',
                    'description' => 'Menu 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'See All Menu',
                    'link_action' => 'admin/menus',
                    'is_public'   => '1',
                    'description' => 'See All Menu 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ],[
                    'name_action' => 'Create Menu',
                    'link_action' => 'admin/menus',
                    'is_public'   => '1',
                    'description' => 'Create Menu 1',
                    'is_delete'   => '0',
                    'created_at'  => DB::raw('now()'),
                    'updated_at'  => DB::raw('now()'),
                ]

            ];
            DB::table('actions')->insert($actions);
        }
    }
}
