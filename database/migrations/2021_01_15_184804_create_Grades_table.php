<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('Grades', function(Blueprint $table) {
			$table->id();
			$table->string('Name');
        	$table->text('Notes')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Grades');
	}
}
