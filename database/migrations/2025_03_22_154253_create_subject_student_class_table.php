<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectStudentClassTable extends Migration
{
    public function up()
    {
        Schema::create('subject_student_class', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('student_class_id');
            $table->primary(['subject_id', 'student_class_id']);
            $table->timestamps();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('student_class_id')->references('id')->on('student_classes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subject_student_class');
    }
}
