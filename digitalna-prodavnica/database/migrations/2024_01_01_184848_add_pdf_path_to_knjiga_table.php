<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('knjiga', function (Blueprint $table) {
            $table->string('pdf_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('knjiga', function (Blueprint $table) {
            $table->dropColumn('pdf_path');
        });
    }
};
