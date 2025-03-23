<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeAndCorrectAnswerToQuestions extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Add a column to indicate the type of question.
            // It can be either 'multiple_choice' or 'open_answer'.
            $table->string('type')->default('multiple_choice')->after('subject_id');

            // For open answer questions, store the expected answer (if applicable)
            $table->text('correct_answer')->nullable()->after('correct_option');
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['type', 'correct_answer']);
        });
    }
}
