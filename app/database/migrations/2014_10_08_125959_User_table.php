<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTable extends Migration {

	public function up()
	{
	    Schema::create('users', function($table)
	    {
	        $table->increments('id');
	        $table->string('username');
	        $table->string('email')->unique();
	        $table->string('name');
	        $table->string('password');
	        $table->string('avatar');
	        $table->string('facebook');
	        $table->string('twitter');
	        $table->timestamps();
	    });
	}

	public function down()
	{
	    Schema::drop('users');
	}

}
