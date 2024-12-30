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
        Schema::table('nocs', function (Blueprint $table) {
            $table->integer('clerk_status')->default(0)->comment('0 => Pending, 1 => Approve, 2 => Reject')->after('approval_status');
            $table->text('clerk_remark')->nullable()->after('clerk_status');

            $table->integer('jr_eng_status')->default(0)->comment('0 => Pending, 1 => Approve, 2 => Reject')->after('clerk_remark');
            $table->text('jr_eng_remark')->nullable()->after('jr_eng_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nocs', function (Blueprint $table) {
            //
        });
    }
};
