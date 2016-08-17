<?php

use App\User;
use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



       $admin = new User();
       $admin->alumni_no = '000000001';
       $admin->student_no = '000000001';
       $admin->first_name = 'I';
       $admin->middle_name = 'am';
       $admin->last_name = 'User';
       $admin->suffix_name = '';
       $admin->civil_status = 'Single';
       $admin->gender = 'Male';
       $admin->date_of_birth = '1991-01-01';
       $admin->email = 'user@example.com';
       $admin->password = bcrypt('user123');
       $admin->landline_no='';
       $admin->cellphone_no='';
       $admin->level='';
       $admin->year='';
       $admin->course='';
       $admin->major='';
       $admin->motto_in_life='';
       $admin->father_name ='';
       $admin->is_father_paulinian = 1; 
       $admin->father_occupation = '';
       $admin->father_office = '';
       $admin->mother_name = '';
       $admin->is_mother_paulinian = 1;
       $admin->mother_occupation = '';
       $admin->mother_office = ' ';
       $admin->is_activated = 1;
       $admin->status = 1;
       $admin->save();

       /*Role*/
       $roleAdmin = Role::where('name', '=' , 'user')->first();
       $admin->attachRole($roleAdmin);

       /*Permission*/
       $roleList = Permission::where('id', '=' , '1')->first();
       $roleCreate = Permission::where('id', '=' , '2')->first();
       $roleEdit = Permission::where('id', '=' , '3')->first();
       $roleDelete = Permission::where('id', '=' , '4')->first();

       $roleAdmin->attachPermissions(array($roleList,$roleCreate,$roleEdit,$roleDelete));
      




    }
}
