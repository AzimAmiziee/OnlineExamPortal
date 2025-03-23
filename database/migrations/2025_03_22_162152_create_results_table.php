<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->unsignedBigInteger('subject_id');

            $table->integer('score')->nullable();

            $table->string('grade')->nullable();

            $table->date('exam_date')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('student_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('subject_id')
                  ->references('id')->on('subjects')
                  ->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
