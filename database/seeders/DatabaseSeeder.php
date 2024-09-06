<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $groupId = DB::table('groups')->insertGetId([
//            'name' => 'Admin',
//            'user_id' => 0,
//            'permissions' => "Test",
//        ]);
//
//        if ($groupId > 0) {
//            $userId = DB::table('users')->insertGetId([
//                'name' => 'Nam Hoang',
//                'group_id' => $groupId,
//                'email' => 'hoang'.rand(100,10000).'@gmail.com',
//                'avatar' => "",
//                'password' => Hash::make('11111111'),
//                'created_at' => date('Y-m-d H:i:s'),
//                'updated_at' => date('Y-m-d H:i:s'),
//            ]);
//        }
//        if ($userId > 0) {
//            DB::table('test_posts')->insert([
//                'title' => 'Tiêu đề 1',
//                'content' => 'Content 1',
//                'user_id' => $userId,
//                'status' => "0",
//                'created_at' => date('Y-m-d H:i:s'),
//                'updated_at' => date('Y-m-d H:i:s'),
//            ]);
//        }
//        DB::table('modules')->insert([
//           'name' =>'users',
//           'title' =>'Quản lí người dùng',
//           'created_at' =>date('Y-m-d H:i:s'),
//           'updated_at' =>date('Y-m-d H:i:s'),
//        ]);
//        DB::table('modules')->insert([
//            'name' => 'groups',
//            'title' => 'Quản lí nhóm',
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s'),
//        ]);
        DB::table('api_posts')->insert([
//            'name' => 'Bài viết ' . rand(1, 100),
            'title' => 'title '.rand(1, 100),
            'content' => 'Content' .rand(1, 100),
            'user_id' => 31
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s'),
        ]);  DB::table('api_posts')->insert([
//            'name' => 'Bài viết ' . rand(1, 100),
            'title' => 'title '.rand(1, 100),
            'content' => 'Content' .rand(1, 100),
            'user_id' => 29
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
