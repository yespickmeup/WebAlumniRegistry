<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alumni_no');
            $table->string('student_no');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('suffix_name');
            $table->string('civil_status');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('landline_no');
            $table->string('cellphone_no');
            $table->string('level');
            $table->string('year');
            $table->string('course');
            $table->string('major');
            $table->string('motto_in_life');
            $table->string('father_name');
            $table->integer('is_father_paulinian');
            $table->string('father_occupation');
            $table->string('father_office');
            $table->string('mother_name');
            $table->integer('is_mother_paulinian');
            $table->string('mother_occupation');
            $table->string('mother_office');
            $table->integer('is_activated');
            $table->integer('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
