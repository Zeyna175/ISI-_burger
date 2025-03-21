<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            \DB::statement("ALTER TABLE users MODIFY role ENUM('client', 'gestionnaire', 'admin') DEFAULT 'client'");
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            \DB::statement("ALTER TABLE users MODIFY role ENUM('client', 'gestionnaire') DEFAULT 'client'");
        });
    }
};