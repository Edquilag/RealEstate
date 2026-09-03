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
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('approved')->after('role');
            $table->timestamp('approved_at')->nullable()->after('status');
            $table->timestamp('rejected_at')->nullable()->after('approved_at');
            $table->text('approval_notes')->nullable()->after('rejected_at');
            $table->string('prc_license_number')->nullable()->after('approval_notes');
            $table->date('prc_license_expiry')->nullable()->after('prc_license_number');
            $table->string('tin')->nullable()->after('prc_license_expiry');
            $table->string('company_name')->nullable()->after('tin');
            $table->string('office_address')->nullable()->after('company_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'approved_at',
                'rejected_at',
                'approval_notes',
                'prc_license_number',
                'prc_license_expiry',
                'tin',
                'company_name',
                'office_address',
            ]);
        });
    }
};
