<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('noc_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('application_id')->nullable();
            $table->integer('document_id')->nullable();
            $table->string('file_path')->nullable();
            $table->boolean('is_image')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noc_documents');
    }
};
