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
            $table->integer('sr_eng_status')->default(0)->comment('0 => Pending, 1 => Approve, 2 => Reject')->after('jr_eng_remark');
            $table->text('sr_eng_remark')->nullable()->after('sr_eng_status');

            $table->integer('hod_status')->default(0)->comment('0 => Pending, 1 => Approve, 2 => Reject')->after('sr_eng_remark');
            $table->text('hod_remark')->nullable()->after('hod_status');

            $table->integer('city_eng_status')->default(0)->comment('0 => Pending, 1 => Approve, 2 => Reject')->after('hod_remark');
            $table->text('city_eng_remark')->nullable()->after('city_eng_status');
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
