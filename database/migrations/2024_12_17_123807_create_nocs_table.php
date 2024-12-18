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
        Schema::create('nocs', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->nullable();
            $table->string('applicant_name')->nullable();
            $table->date('date')->nullable();
            $table->string('property_type')->nullable();
            $table->string('address_of_applicant')->nullable();
            $table->string('address_of_property')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('addhar_no')->nullable();
            $table->enum('approval_status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nocs');
    }
};
