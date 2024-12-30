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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('aproved_status')->default('pending'); // pending, approved, rejected
            $table->tinyInteger('approval_level')->default(4); // Start at Clerk (4)
            $table->unsignedBigInteger('assigned_user_id')->nullable(); // User handling the request
            $table->text('comments')->nullable(); // For approval/rejection notes
            $table->timestamps();
            
            // Foreign key for user assignment (Optional)
            $table->foreign('assigned_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
