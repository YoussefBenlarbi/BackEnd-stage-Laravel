<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name'  =>  'admin',
            'email' =>  'admin@gmail.com',
            'password'  =>  Hash::make('password'),
            'is_admin'  =>  1,
            'is_active'  =>  1,
        ]);
        UserDetail::create([
            'user_id'   =>  $user1->id,
            'cin' => 'EE812337',
            'address' => 'Hay Zitoun 4 N 49',
            'sexe' => 'male',
        ]);
        $user2 = User::create([
            'name'  =>  'user',
            'email' =>  'user@gmail.com',
            'password'  =>  Hash::make('password'),
            'is_admin'  =>  0,
            'is_active'  =>  1,
        ]);
        UserDetail::create([
            'user_id'   =>  $user2->id,
            'cin' => 'FF882337',
            'address' => 'Daoudiaat',
            'sexe' => 'female',
        ]);
        $user3 = User::create([
            'name'  =>  'benlarbi',
            'email' =>  'benlarbi11@gmail.com',
            'password'  =>  Hash::make('password'),
            'is_admin'  =>  0,
            'is_active'  =>  0,
        ]);
        UserDetail::create([
            'user_id'   =>  $user3->id,
            'cin' => 'TT922337',
            'address' => 'Gueliz',
            'sexe' => 'male',
        ]);
    }
}
