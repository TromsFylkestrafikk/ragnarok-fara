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
        $this->timestampToDatetime('fara_stat_load', 'lastupdated', 'Last updated. Date/time', false);
        $this->timestampToDatetime('fara_stat_traffic_cust_profile', 'lastupdated', 'Last updated. Date/time');
        $this->timestampToDatetime('fara_stat_traffic_income', 'lastupdated', 'Last updated. Date/time');
        $this->timestampToDatetime('fara_arch', 'eventdatetime', 'Date/time of event', false);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }

    /**
     * Convert a db column from TIMESTAMP to DATETIME.
     *
     * Unfortunately Laravel's ->change() doesn't take on this kind of
     * conversion so it have to be done manually:
     * 1) Rename original column to ..._old
     * 2) Create new DATETIME column with same name as original.
     * 3) Copy data from original to new column (No need for conversion as this
     *    is handled by mysql/mariadb)
     * 4) Drop original, renamed column
     */
    protected function timestampToDatetime(string $tableName, string $columnName, string $comment, $nullable = true)
    {
        Schema::table($tableName, function (Blueprint $table) use ($columnName){
            $table->renameColumn($columnName, $columnName . '_old');
        });

        Schema::table($tableName, function (Blueprint $table) use ($columnName, $comment) {
            $table->dateTime($columnName)->nullable()->after($columnName . '_old')->comment($comment);
        });

        DB::table($tableName)->update([$columnName => DB::raw($columnName . '_old')]);

        if (!$nullable) {
            Schema::table($tableName, function (Blueprint $table) use ($columnName, $comment) {
                $table->dateTime($columnName)->nullable(false)->comment($comment)->change();
            });
        }

        Schema::table($tableName, function (Blueprint $table) use ($columnName) {
            $table->dropColumn($columnName . '_old');
        });
    }
};
