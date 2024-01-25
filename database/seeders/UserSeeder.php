<?php

namespace Database\Seeders;

use App\Constants\Role;
use App\Constants\Status;
use App\Constants\Type;
use App\Models\Country;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name'=>'Admin',
           'email'=>'admin@test.com',
           'username'=>'admin',
            'role'=>Role::ADMIN,
            'status'=>Status::ACTIVE,
            'password'=>Hash::make('password'),
            'type'=> Type::FULL_TIME,
            'hire_date'=>date('Y-m-d'),
            'phone'=>'01747139997',
            'birth_date' => '1999-02-12',
            'address'=>'Dhaka',
            'country_id'=> Country::first()->id,
            'department_id'=>Department::first()->id,
            'designation_id' => Designation::first()->id,

        ]);
    }
}
