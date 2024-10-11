<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Removes non-critical columns that otherwise just takes up space and widens a
 * few text columns to avoid future problems.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fara_basic_journey', function (Blueprint $table) {
            $table->char('publiclineno')->nullable()->comment('Public line number')->change();
            $table->dropColumn([
                'remarkida',
                'remark2ida',
                'packagetour',
                'announcementtype',
                'tariffid',
                'tarifftype',
            ]);
        });

        Schema::table('fara_basic_line', function (Blueprint $table) {
            $table->char('linename')->nullable()->comment('Line name')->change();
            $table->dropColumn(['tariffid']);
        });

        Schema::table('fara_basic_stop', function (Blueprint $table) {
            $table->char('stopname')->comment('Stop place name')->change();
            $table->dropColumn([
                'stopshortname',
                'tariffzone',
                'xcoordinate',
                'ycoordinate',
            ]);
        });

        Schema::table('fara_basic_template', function (Blueprint $table) {
            $table->char('description')->comment('Ticket description')->change();
        });

        Schema::table('fara_company', function (Blueprint $table) {
            $table->char('companyname')->comment('Company name')->change();
            $table->char('orgno')->nullable()->comment('Org. number')->change();
            $table->dropColumn([
                'companyshortname',
                'csurl',
                'address',
                'postalcodeid',
                'accountnumber',
            ]);
        });

        Schema::table('fara_customer_profile', function (Blueprint $table) {
            $table->char('custprofiledesc')->nullable()->comment('Description')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fara_basic_journey', function (Blueprint $table) {
            $table->unsignedBigInteger('remarkida')->after('calendarida')->nullable();
            $table->unsignedBigInteger('remark2ida')->after('remarkida')->nullable();
            $table->smallInteger('packagetour')->after('departuretime')->nullable();
            $table->smallInteger('announcementtype')->after('packagetour')->nullable();
            $table->unsignedBigInteger('tariffid')->after('announcementtype')->nullable();
            $table->char('tarifftype')->after('direction')->nullable();
        });

        Schema::table('fara_basic_line', function (Blueprint $table) {
            $table->unsignedBigInteger('tariffid')->after('linename')->nullable();
        });

        Schema::table('fara_basic_stop', function (Blueprint $table) {
            $table->char('stopshortname')->after('stopname')->comment('Shortened stop place name');
            $table->char('tariffzone')->after('stopshortname')->nullable();
            $table->integer('xcoordinate')->after('tariffzone')->nullable()->comment('X coordinate. Not GPS value');
            $table->integer('ycoordinate')->after('xcoordinate')->nullable()->comment('Y coordinate. Not GPS value');
        });

        Schema::table('fara_company', function (Blueprint $table) {
            $table->char('companyshortname')->after('isself')->nullable()->comment('Shortened company name');
            $table->char('csurl')->after('carddbcompanyid')->nullable();
            $table->char('address')->after('islocal')->nullable();
            $table->integer('postalcodeid')->after('address')->nullable();
            $table->char('accountnumber')->after('postalcodeid')->nullable();
        });
    }
};
