<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->timestampToDatetime('fara_stat_load', 'lastupdated', 'Last updated. Date/time');
        $this->timestampToDatetime('fara_stat_traffic_cust_profile', 'lastupdated', 'Last updated. Date/time');
        $this->timestampToDatetime('fara_stat_traffic_income', 'lastupdated', 'Last updated. Date/time');
        $this->timestampToDatetime('fara_arch', 'eventdatetime', 'Date/time of event');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }

    protected function timestampToDatetime(string $tableName, string $columnName, string $comment)
    {
        Schema::table($tableName, function (Blueprint $table) use ($columnName){
            $table->renameColumn($columnName, $columnName . '_old');
        });

        Schema::table($tableName, function (Blueprint $table) use ($columnName, $comment) {
            $table->dateTime($columnName)->nullable()->after($columnName . '_old')->comment($comment);
        });

        DB::table($tableName)->update([$columnName => DB::raw($columnName . '_old')]);

        Schema::table($tableName, function (Blueprint $table) use ($columnName) {
            $table->dropColumn($columnName . '_old');
        });
    }
};
