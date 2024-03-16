<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('from_grade'); //جي من انهي مرحلة
            $table->unsignedBigInteger('from_Classroom'); //جي من انهي صف
            $table->unsignedBigInteger('from_section'); //جي من انهي قسم

            $table->unsignedBigInteger('to_grade'); //هيروح انهي مرحلة
            $table->unsignedBigInteger('to_Classroom'); //هيروح انهي صف
            $table->unsignedBigInteger('to_section'); //هيروح انهي قسم
            $table->string('academic_year'); 
            $table->string('academic_year_new');
            $table->timestamps();
        });

        //add foreign key to table promotion 
        Schema::table('promotions', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('from_grade')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreign('from_Classroom')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreign('from_section')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('to_grade')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreign('to_Classroom')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreign('to_section')->references('id')->on('sections')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
