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
            $table->unsignedBigInteger('journeyida')->primary()->comment('Journey ID');
            $table->unsignedBigInteger('lineida')->comment('Line ID');
            $table->integer('journeyno')->comment('Journey number');
            $table->unsignedBigInteger('calendarida')->comment('Calendar ID');
            $table->unsignedBigInteger('remarkida')->nullable();
            $table->unsignedBigInteger('remark2ida')->nullable();
            $table->integer('destnodep')->nullable();
            $table->char('publiclineno', 8)->nullable()->comment('Public line number');
            $table->unsignedBigInteger('journeypatternida')->nullable()->comment('Journey pattern ID');
            $table->integer('departuretime');
            $table->smallInteger('packagetour')->nullable();
            $table->smallInteger('announcementtype')->nullable();
            $table->unsignedBigInteger('tariffid')->nullable();
            $table->integer('transporttypeid')->nullable();
            $table->integer('destnoarrival')->nullable();
            $table->integer('trafficdays')->nullable();
            $table->unsignedBigInteger('serviceproviderid')->comment('Service provider/Company ID');
            $table->integer('inversecalendar');
            $table->integer('direction');
            $table->string('tarifftype', 30)->nullable();
        });

        Schema::create('fara_basic_line', function (Blueprint $table)
        {
            $table->unsignedBigInteger('lineida')->primary()->comment('Line ID');
            $table->unsignedBigInteger('routeproviderid')->comment('Route provider/Company ID');
            $table->integer('linenumber')->comment('Line number');
            $table->string('linename', 50)->nullable()->comment('Line name');
            $table->unsignedBigInteger('tariffid')->nullable();
        });

        Schema::create('fara_basic_stop', function (Blueprint $table)
        {
            $table->integer('stopno')->primary()->comment('Stop number/ID. Not NSR stop place number');
            $table->string('stopname', 50)->comment('Stop place name');
            $table->char('stopshortname', 6)->comment('Shortened stop place name');
            $table->char('tariffzone', 6)->nullable();
            $table->integer('xcoordinate')->nullable()->comment('X coordinate. Not GPS value');
            $table->integer('ycoordinate')->nullable()->comment('Y coordinate. Not GPS value');
            $table->integer('zoneid')->comment('Zone ID');
            $table->smallInteger('stoptype')->nullable()->comment('Stop type');
        });

        Schema::create('fara_basic_template', function (Blueprint $table)
        {
            $table->unsignedBigInteger('templateid')->primary()->comment('Template ID. Ticket type');
            $table->unsignedBigInteger('companyid')->comment('Company ID');
            $table->integer('templateno')->comment('Template number');
            $table->integer('classid');
            $table->string('description', 50)->comment('Ticket description');
            $table->integer('seqno')->comment('Sequence number');
        });

        Schema::create('fara_company', function (Blueprint $table)
        {
            $table->unsignedBigInteger('companyid')->primary()->comment('Company ID');
            $table->string('companyname', 50)->comment('Company name');
            $table->integer('countrycode');
            $table->integer('networkno');
            $table->integer('companyno')->comment('Company number');
            $table->integer('isself');
            $table->char('companyshortname', 10)->nullable()->comment('Shortened company name');
            $table->char('orgno', 15)->nullable()->comment('Org. number');
            $table->unsignedBigInteger('carddbcompanyid');
            $table->string('csurl', 50)->nullable();
            $table->integer('islocal');
            $table->string('address', 50)->nullable();
            $table->integer('postalcodeid')->nullable();
            $table->char('accountnumber', 20)->nullable();
        });

        Schema::create('fara_customer_profile', function (Blueprint $table)
        {
            $table->smallInteger('custprofileid')->primary()->comment('Customer profile ID');
            $table->string('custprofiledesc', 50)->nullable()->comment('Description');
        });

        Schema::create('fara_stat_load', function (Blueprint $table)
        {
            $table->date('dat')->comment('Date');
            $table->unsignedBigInteger('companyid')->comment('Company ID');
            $table->unsignedBigInteger('routecompanyid')->comment('Route provider/Company ID');
            $table->integer('linenumber')->comment('Line number');
            $table->integer('journeyno')->comment('Journey number');
            $table->smallInteger('assistanceno')->comment('Assistance number');
            $table->unsignedBigInteger('prodcompanyid')->comment('Product owner/Company ID');
            $table->integer('prodtemplateno')->comment('Product template number');
            $table->smallInteger('custprofileid')->comment('Customer profile ID');
            $table->integer('zone')->comment('Zone ID');
            $table->integer('stop')->comment('Stop ID');
            $table->integer('numberofproductsuse')->nullable();
            $table->integer('numberofproductsoff');
            $table->timestamp('lastupdated')->comment('Last updated. Date/time');
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
            $table->date('dat')->index()->comment('Date');
            $table->unsignedBigInteger('companyid')->comment('Company ID');
            $table->unsignedBigInteger('operatorid')->comment('Operator ID');
            $table->unsignedBigInteger('routecompanyid')->comment('Route provider/Company ID');
            $table->integer('linenumber')->comment('Line number');
            $table->integer('journeyno')->comment('Journey number');
            $table->smallInteger('assistanceno')->comment('Assistance number');
            $table->unsignedBigInteger('prodcompanyid')->comment('Product owner/Company ID');
            $table->integer('prodtemplateno')->comment('Product template number');
            $table->smallInteger('custprofileid')->comment('Customer profile ID');
            $table->integer('vehiclerunno')->comment('Vehicle run number');
            $table->integer('numberofproductsuse')->nullable();
            $table->timestamp('lastupdated')->nullable()->comment('Last updated. Date/time');
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
            $table->date('dat')->index()->comment('Date');
            $table->unsignedBigInteger('companyid')->comment('Company ID');
            $table->unsignedBigInteger('operatorid')->comment('Operator ID');
            $table->unsignedBigInteger('routecompanyid')->comment('Route provider/Company ID');
            $table->integer('linenumber')->comment('Line number');
            $table->integer('journeyno')->comment('Journey number');
            $table->smallInteger('assistanceno')->comment('Assistance number');
            $table->unsignedBigInteger('prodcompanyid')->comment('Product owner/Company ID');
            $table->integer('prodtemplateno')->comment('Product template number');
            $table->smallInteger('custprofileid')->comment('Customer profile ID');
            $table->smallInteger('paymentmethodid')->comment('Payment method ID');
            $table->integer('vehiclerunno')->comment('Vehicle run number');
            $table->float('amountofproductssale', 10, 3)->nullable()->default(NULL);
            $table->integer('numberofproductssale')->nullable();
            $table->unsignedBigInteger('clearingperiodida');
            $table->timestamp('lastupdated')->nullable()->comment('Last updated. Date/time');
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
