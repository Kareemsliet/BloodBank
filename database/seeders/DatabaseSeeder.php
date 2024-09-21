<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\HeroPages;
use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       DB::insert("INSERT INTO permissions (`name`,`guard_name`,`created_at`,`updated_at`) VALUES ('اضافة مقالات','web',NOW(),NOW()),('تعديل مقال','web',NOW(),NOW()),('اضافة مدن','web',NOW(),NOW()),('تعديل مدن','web',NOW(),NOW()),('عرض المدن','web',NOW(),NOW())");
   //     DB::insert("insert into roles (name,guard_name,created_at,updated_at) VALUES ('admin','web',NOW(),NOW()),('creator','web',NOW(),NOW()),('editor','web',NOW(),NOW())");

//    $editor=Role::where('name','editor')->first();

//    $creator=Role::where('name','creator')->first();

//    $admin=Role::where('name','admin')->first();

//    $editor->givePermissionTo(['تعديل مدن','تعديل مقال']);

//    $creator->givePermissionTo(['اضافة مقالات','اضافة مدن']);

//    $admin->givePermissionTo(['عرض المدن']);

    //   User::find(1)->assignRole('admin');

    //   User::find(2)->assignRole('editor');

    //   User::find(3)->assignRole('creator');
     }
}
