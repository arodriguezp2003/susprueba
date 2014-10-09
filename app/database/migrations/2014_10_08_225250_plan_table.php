<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlanTable extends Migration {

	public function up()
	{
	    Schema::create('plans', function($table)
	    {
	        $table->increments('id');
	        $table->string('codigo');
	        $table->string('nombre');
	        $table->text('descripcion');
	        $table->string('monto');
	        $table->string('moneda');
	        $table->string('tiempo');
	        $table->string('trial');
	        $table->string('desc');
	        $table->timestamps();
	    });
	}

	public function down()
	{
	    Schema::drop('plans');
	}

}
