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
        Schema::create('fara_basic_journey', function (Blueprint $table)
        {
            $table->unsignedBigInteger('journeyida')->primary();
            $table->unsignedBigInteger('lineida');
            $table->integer('journeyno');
            $table->unsignedBigInteger('calendarida');
            $table->unsignedBigInteger('remarkida')->nullable();
            $table->unsignedBigInteger('remark2ida')->nullable();
            $table->integer('destnodep')->nullable();
            $table->char('publiclineno', 8)->nullable();
            $table->unsignedBigInteger('journeypatternida')->nullable();
            $table->integer('departuretime');
            $table->smallInteger('packagetour')->nullable();
            $table->smallInteger('announcementtype')->nullable();
            $table->unsignedBigInteger('tariffid')->nullable();
            $table->integer('transporttypeid')->nullable();
            $table->integer('destnoarrival')->nullable();
            $table->integer('trafficdays')->nullable();
            $table->unsignedBigInteger('serviceproviderid');
            $table->integer('inversecalendar');
            $table->integer('direction');
            $table->string('tarifftype', 30)->nullable();
        });

        Schema::create('fara_basic_line', function (Blueprint $table)
        {
            $table->unsignedBigInteger('lineida')->primary();
            $table->unsignedBigInteger('routeproviderid');
            $table->integer('linenumber');
            $table->string('linename', 50)->nullable();
            $table->unsignedBigInteger('tariffid')->nullable();
        });

        Schema::create('fara_basic_stop', function (Blueprint $table)
        {
            $table->integer('stopno')->primary();
            $table->string('stopname', 50);
            $table->char('stopshortname', 6);
            $table->char('tariffzone', 6)->nullable();
            $table->integer('xcoordinate')->nullable();
            $table->integer('ycoordinate')->nullable();
            $table->integer('zoneid');
            $table->smallInteger('stoptype')->nullable();
        });

        Schema::create('fara_basic_template', function (Blueprint $table)
        {
            $table->unsignedBigInteger('templateid')->primary();
            $table->unsignedBigInteger('companyid');
            $table->integer('templateno');
            $table->integer('classid');
            $table->string('description', 50);
            $table->integer('seqno');
        });

        Schema::create('fara_company', function (Blueprint $table)
        {
            $table->unsignedBigInteger('companyid')->primary();
            $table->string('companyname', 50);
            $table->integer('countrycode');
            $table->integer('networkno');
            $table->integer('companyno');
            $table->integer('isself');
            $table->char('companyshortname', 10)->nullable();
            $table->char('orgno', 15)->nullable();
            $table->unsignedBigInteger('carddbcompanyid');
            $table->string('csurl', 50)->nullable();
            $table->integer('islocal');
            $table->string('address', 50)->nullable();
            $table->integer('postalcodeid')->nullable();
            $table->char('accountnumber', 20)->nullable();
        });

        Schema::create('fara_customer_profile', function (Blueprint $table)
        {
            $table->smallInteger('custprofileid')->index();
            $table->string('custprofiledesc', 50)->nullable();
        });

        Schema::create('fara_stat_load', function (Blueprint $table)
        {
            $table->date('dat');
            $table->unsignedBigInteger('companyid');
            $table->unsignedBigInteger('routecompanyid');
            $table->integer('linenumber');
            $table->integer('journeyno');
            $table->smallInteger('assistanceno');
            $table->unsignedBigInteger('prodcompanyid');
            $table->integer('prodtemplateno');
            $table->smallInteger('custprofileid');
            $table->integer('zone');
            $table->integer('stop');
            $table->integer('numberofproductsuse')->nullable();
            $table->integer('numberofproductsoff');
            $table->timestamp('lastupdated');
            $table->primary([
                'dat',
                'stop',
                'zone',
                'companyid',
                'journeyno',
                'linenumber',
                'assistanceno',
                'custprofileid',
                'prodcompanyid',
                'prodtemplateno',
                'routecompanyid',
            ], 'statload_index_pk');
        });

        Schema::create('fara_stat_traffic_cust_profile', function (Blueprint $table)
        {
            $table->date('dat')->index();
            $table->unsignedBigInteger('companyid');
            $table->unsignedBigInteger('operatorid');
            $table->unsignedBigInteger('routecompanyid');
            $table->integer('linenumber');
            $table->integer('journeyno');
            $table->smallInteger('assistanceno');
            $table->unsignedBigInteger('prodcompanyid');
            $table->integer('prodtemplateno');
            $table->smallInteger('custprofileid');
            $table->integer('vehiclerunno');
            $table->integer('numberofproductsuse')->nullable();
            $table->timestamp('lastupdated')->nullable();
            $table->primary([
                'dat',
                'companyid',
                'journeyno',
                'linenumber',
                'operatorid',
                'assistanceno',
                'vehiclerunno',
                'custprofileid',
                'prodcompanyid',
                'prodtemplateno',
                'routecompanyid',
            ], 'stattrafficcustprofile_index_pk');
        });

        Schema::create('fara_stat_traffic_income', function (Blueprint $table)
        {
            $table->date('dat')->index();
            $table->unsignedBigInteger('companyid');
            $table->unsignedBigInteger('operatorid');
            $table->unsignedBigInteger('routecompanyid');
            $table->integer('linenumber');
            $table->integer('journeyno');
            $table->smallInteger('assistanceno');
            $table->unsignedBigInteger('prodcompanyid');
            $table->integer('prodtemplateno');
            $table->smallInteger('custprofileid');
            $table->smallInteger('paymentmethodid');
            $table->integer('vehiclerunno');
            $table->unsignedFloat('amountofproductssale', 10, 3)->nullable()->default(NULL);
            $table->integer('numberofproductssale')->nullable();
            $table->unsignedBigInteger('clearingperiodida');
            $table->timestamp('lastupdated')->nullable();
            $table->primary([
                'dat',
                'companyid',
                'journeyno',
                'linenumber',
                'operatorid',
                'assistanceno',
                'vehiclerunno',
                'custprofileid',
                'prodcompanyid',
                'prodtemplateno',
                'routecompanyid',
                'paymentmethodid',
                'clearingperiodida',
            ], 'stattrafficincome_index_pk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fara_basic_journey');
        Schema::dropIfExists('fara_basic_line');
        Schema::dropIfExists('fara_basic_stop');
        Schema::dropIfExists('fara_basic_template');
        Schema::dropIfExists('fara_company');
        Schema::dropIfExists('fara_customer_profile');
        Schema::dropIfExists('fara_stat_load');
        Schema::dropIfExists('fara_stat_traffic_cust_profile');
        Schema::dropIfExists('fara_stat_traffic_income');
    }
};
