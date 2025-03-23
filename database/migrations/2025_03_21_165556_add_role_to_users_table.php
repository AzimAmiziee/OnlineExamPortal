<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('student')->after('password'); // Ensure role is properly saved
        });
    }

    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('student'); // Default role is student
        });
    }
};
