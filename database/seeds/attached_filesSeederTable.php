<?php

use Illuminate\Database\Seeder;

class attached_filesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('attached_files')->get()->count() == 0) {
            $attached_files = [
                [
                    'name_file'        => 'Ảnh đại diện.',
                    'attached_file'    => 'ExPAAR8G0wohMrJrGlvjg0Sv6LUPNlmeklKbcFTr.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/users/2018/07/09/5/',
                    'type_file'        => '0',
                    'parent_object_id' => '3',
                    'object_id'        => '5',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    
                    'name_file'        => 'Ảnh đại diện.',
                    'attached_file'    => 'BrmjG1akQvSMGQWXWmjK9rQQpJmv0Ao5gkzTea1V.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/users/2018/07/09/4/',
                    'type_file'        => '0',
                    'parent_object_id' => '3',
                    'object_id'        => '4',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    
                    'name_file'        => 'Ảnh đại diện.',
                    'attached_file'    => 'ExPAAR8G0wohMrJrGlvjg0Sv6LUPNlmeklKbcFTr.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/users/2018/07/09/3/',
                    'type_file'        => '0',
                    'parent_object_id' => '3',
                    'object_id'        => '3',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Ảnh đại diện.',
                    'attached_file'    => 'WIrU7mNGjlwGKuIdIagUYSdd0QUaTkzWCENgXiWz.png',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/users/2018/07/09/2/',
                    'type_file'        => '0',
                    'parent_object_id' => '3',
                    'object_id'        => '2',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Ảnh sự kiện',
                    'attached_file'    => 'wiW4ecqGz05Ew3t3ASYHcfek5Enn1zFaTMJ0Oj05.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/events/2018/07/10/1/',
                    'type_file'        => '0',
                    'parent_object_id' => '2',
                    'object_id'        => '4',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Ảnh sự kiện',
                    'attached_file'    => 'YJL5OJ2ytaqjqYI0Wvp1h2sJOA3qm5IEk33f6S1T.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/events/2018/07/10/1/',
                    'type_file'        => '0',
                    'parent_object_id' => '2',
                    'object_id'        => '4',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Ảnh sự kiện',
                    'attached_file'    => 'YJL5OJ2ytaqjqYI0Wvp1h2sJOA3qm5IEk33f6S1T.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/events/2018/07/10/2/',
                    'type_file'        => '0',
                    'parent_object_id' => '2',
                    'object_id'        => '2',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Ảnh sự kiện',
                    'attached_file'    => 'ZYdmdW45ooL8017WEtYeG21S0wuImywge5K0jtvG.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/events/2018/07/10/2/',
                    'type_file'        => '0',
                    'parent_object_id' => '2',
                    'object_id'        => '2',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Logo Company',
                    'attached_file'    => 'v7W9nW2unp6Mso4xDlsUtaqEmusqLDvmP1yoZxUs.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/companies/2018/07/09/3/',
                    'type_file'        => '0',
                    'parent_object_id' => '1',
                    'object_id'        => '3',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Logo Company',
                    'attached_file'    => 'WIrU7mNGjlwGKuIdIagUYSdd0QUaTkzWCENgXiWz.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/companies/2018/07/09/3/',
                    'type_file'        => '0',
                    'parent_object_id' => '1',
                    'object_id'        => '3',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Logo Company',
                    'attached_file'    => '4Mewj3VWcazaAxSs2Zp5DMjeMeJjGhIu00wAgzr7.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/companies/2018/07/11/1/',
                    'type_file'        => '0',
                    'parent_object_id' => '1',
                    'object_id'        => '1',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Logo Company',
                    'attached_file'    => '27l3X2IKtJZN4KYzmq9hgUwgwB1y2jfLiUYa1mrs.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/companies/2018/07/11/1/',
                    'type_file'        => '0',
                    'parent_object_id' => '1',
                    'object_id'        => '1',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Logo Company',
                    'attached_file'    => 'LnYiAjdugoK6pTr1xBJ5B1GwtxutGCJ6wPGkYhg5.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/companies/2018/07/11/1/',
                    'type_file'        => '0',
                    'parent_object_id' => '1',
                    'object_id'        => '1',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Ảnh sự kiện',
                    'attached_file'    => '1529372311Tulips.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/events/2018/07/10/3/',
                    'type_file'        => '0',
                    'parent_object_id' => '2',
                    'object_id'        => '3',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Ảnh sự kiện',
                    'attached_file'    => '1529372249Penguins.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/events/2018/07/10/3/',
                    'type_file'        => '0',
                    'parent_object_id' => '2',
                    'object_id'        => '3',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ],[
                    'name_file'        => 'Ảnh sự kiện',
                    'attached_file'    => '1529373243Chrysanthemum.jpg',
                    'describe'         => 'Not yet',
                    'folder'           => 'images/events/2018/07/10/3/',
                    'type_file'        => '0',
                    'parent_object_id' => '2',
                    'object_id'        => '3',
                    'is_delete'        => '0',
                    'created_at'       => DB::raw('now()'),
                    'updated_at'       => DB::raw('now()'),
                ]
            ]; 
            DB::table('attached_files')->insert($attached_files);
        }
    }
}