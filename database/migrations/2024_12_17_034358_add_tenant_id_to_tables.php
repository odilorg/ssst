<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Get all table names from the database
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

        // Exclude specific tables where you don't want tenant_id
        $excludedTables = ['migrations', 'password_resets', 'failed_jobs', 'personal_access_tokens'];

        foreach ($tables as $table) {
            if (!in_array($table, $excludedTables)) {
                Schema::table($table, function (Blueprint $table) {
                    // Only add 'tenant_id' if it does not exist
                    if (!Schema::hasColumn($table->getTable(), 'tenant_id')) {
                        // Avoid 'after' for tables without 'id' columns
                        if (Schema::hasColumn($table->getTable(), 'id')) {
                            $table->unsignedBigInteger('tenant_id')->default(1)->after('id');
                        } else {
                            $table->unsignedBigInteger('tenant_id')->default(1);
                        }
                    }
                });
            }
        }
    }

    public function down(): void
    {
        // Rollback: Drop the tenant_id column from all tables
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();

        $excludedTables = ['migrations', 'password_resets', 'failed_jobs', 'personal_access_tokens'];

        foreach ($tables as $table) {
            if (!in_array($table, $excludedTables)) {
                Schema::table($table, function (Blueprint $table) {
                    if (Schema::hasColumn($table->getTable(), 'tenant_id')) {
                        $table->dropColumn('tenant_id');
                    }
                });
            }
        }
    }
};
