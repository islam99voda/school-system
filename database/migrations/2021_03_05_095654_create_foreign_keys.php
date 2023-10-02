<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('Classrooms', function(Blueprint $table) {
		    $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
		});
		Schema::table('sections', function(Blueprint $table) {
		    $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade');
		});
	}

	public function down()
	{
		
	}
}
