<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeQuestionOptionsNullable extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('option1')->nullable()->change();
            $table->string('option2')->nullable()->change();
            $table->string('option3')->nullable()->change();
            $table->string('option4')->nullable()->change();
            $table->unsignedTinyInteger('correct_option')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Note: Reverting may require a default value or careful handling.
            $table->string('option1')->nullable(false)->change();
            $table->string('option2')->nullable(false)->change();
            $table->string('option3')->nullable(false)->change();
            $table->string('option4')->nullable(false)->change();
            $table->unsignedTinyInteger('correct_option')->nullable(false)->change();
        });
    }
}
