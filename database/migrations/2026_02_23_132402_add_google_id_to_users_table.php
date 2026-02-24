<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
                // Tambahkan kolom google_id setelah kolom id
                $table->string('google_id')->nullable()->after('id');
                // Buat password bisa kosong (nullable) karena user login via Google
                $table->string('password')->nullable()->change();
        });
    }
};
