<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $superadminuser = User::create([
            'name' => 'Admin',
            'phone' => '+998905900343',
            'password' => Hash::make('12345678'),
        ]);

        Admin::create([
            'user_id' => $superadminuser->id,
        ]);

        $superadmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $roleuser = Role::create(['name' => 'user']);

        Permission::create(['name' => 'user update']);
        //order->buyrutma
        Permission::create(['name'=>'order create']);
        //favorite->yoqganlari
        Permission::create(['name'=>'favorite create']);
        //basket->savat
        Permission::create(['name'=>'basket create']);
        //review->izoh qoldirish va baho berish
        Permission::create(['name'=>'review create']);

        $roleuser->syncPermissions(Permission::all());

       //order->buyrutma
        Permission::create(['name'=>'order update']);

        //favorite->yoqganlari
        Permission::create(['name'=>'favorite view']);

        //basket->savat
        Permission::create(['name'=>'basket view']);

        //review->izoh qoldirish va baho berish
        Permission::create(['name'=>'review view']);

        //Category
        Permission::create(['name'=>'category create']);
        Permission::create(['name'=>'category update']);
        Permission::create(['name'=>'category delete']);

        //Book->Kitob
        Permission::create(['name'=>'book create']);
        Permission::create(['name'=>'book update']);
        Permission::create(['name'=>'book delete']);

        //DubAuthor->dublyaj qilgan muallif
        Permission::create(['name'=>'dubauthor create']);
        Permission::create(['name'=>'dubauthor update']);
        Permission::create(['name'=>'dubauthor delete']);

        //Discount->chegirma
        Permission::create(['name'=>'discount create']);
        Permission::create(['name'=>'discount update']);
        Permission::create(['name'=>'discount delete']);

        //DiscBook->chegirmali kitoblar
        Permission::create(['name'=>'discbook create']);
        Permission::create(['name'=>'discbook update']);
        Permission::create(['name'=>'discbook delete']);

        $admin->syncPermissions(Permission::all());

        //Admin
        Permission::create(['name'=>'admin create']);
        Permission::create(['name'=>'admin update']);
        Permission::create(['name'=>'admin delete']);

        // give all permissions to super-admin
        $superadmin->syncPermissions(Permission::all());

        // give role super-admin to user
        $user = User::query()->where('id', 1)->get()->first();
        $user->assignRole($superadmin);
        
        $user->save();
    }
}
