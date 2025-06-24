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
        Schema::create(
            'fara_emv_transaction',
            function (Blueprint $table) {
                $table->bigInteger('emvtransida')->primary();
                $table->bigInteger('transactionid')->index()->nullable();
                $table->char('terminalid', 32)->nullable()->default(NULL);
                $table->char('transactionnumber', 32)->nullable()->default(NULL);
                $table->smallInteger('sessionnumber')->nullable();
                $table->char('pan', 64)->nullable()->default(NULL);
                $table->char('cardexpirydate', 32)->nullable()->default(NULL);
                $table->char('paymentapplicationname')->nullable()->default(NULL);
                $table->char('applicationid')->nullable()->default(NULL);
                $table->char('readingmethod')->nullable()->default(NULL);
                $table->dateTime('transactiondatetime')->nullable()->index();
                $table->char('onlineindicator', 1)->nullable()->default(NULL);
                $table->char('authorizationcode', 32)->nullable()->default(NULL);
                $table->smallInteger('issuerid')->nullable();
                $table->char('cardacceptoridcode', 32)->nullable()->default(NULL);
                $table->char('idmethod', 1)->nullable()->default(NULL);
                $table->float('amount')->nullable();
                $table->smallInteger('iscancelled')->nullable();
                $table->integer('currencyid')->nullable();
                $table->bigInteger('prcompanyid')->nullable()->index();
            }
        );

        Schema::create(
            'fara_emv_trans_raw_trans',
            function (Blueprint $table) {
                $table->bigInteger('emvtransida')->nullable();
                $table->bigInteger('transida');
                $table->primary(['emvtransida', 'transida']);
            }
        );

        Schema::create(
            'fara_raw_transaction',
            function (Blueprint $table) {
                $table->bigInteger('transida')->primary();
                $table->bigInteger('transtypeid')->nullable()->default(NULL);
                $table->bigInteger('serviceproviderid')->nullable()->default(NULL);
                $table->bigInteger('serviceoperatorid')->nullable()->default(NULL);
                $table->bigInteger('productretailerid')->nullable()->default(NULL);
                $table->bigInteger('applicationretailerid')->nullable()->default(NULL);
                $table->bigInteger('producttemplateownerid')->nullable()->default(NULL);
                $table->bigInteger('producttemplateno')->nullable()->default(NULL);
                $table->integer('productapplicationsequenceno')->nullable();
                $table->bigInteger('applicationtemplateownerid')->nullable()->default(NULL);
                $table->integer('applicationtemplateno')->nullable();
                $table->bigInteger('applicationtemplatesequenceno')->nullable()->default(NULL);
                $table->char('applicatoinserialno')->nullable()->default(NULL);
                $table->dateTime('receivedtimestamp')->nullable();
                $table->dateTime('eventtimestamp')->nullable()->index();
                $table->bigInteger('eventsequenceno')->nullable()->default(NULL);
                $table->integer('orderid')->nullable();
                $table->bigInteger('settlementseqno')->nullable()->default(NULL);
                $table->bigInteger('operatorcardid')->nullable()->default(NULL);
                $table->bigInteger('operatorcardtypeid')->nullable()->default(NULL);
                $table->bigInteger('operatorcardissuerid')->nullable()->default(NULL);
                $table->bigInteger('operatorcompanyid')->nullable()->default(NULL);
                $table->bigInteger('operatorid')->nullable()->default(NULL);
                $table->integer('usercardtypeid')->nullable();
                $table->char('usercardserialno')->nullable()->default(NULL);
                $table->bigInteger('usercardissuerid')->nullable()->default(NULL);
                $table->bigInteger('devicecompanyid')->nullable()->default(NULL);
                $table->bigInteger('deviceserialno')->nullable()->default(NULL);
                $table->bigInteger('recievedfromcompanyid')->nullable()->default(NULL);
                $table->integer('formatversion')->nullable();
                $table->boolean('isfailed')->nullable();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fara_emv_transaction');
        Schema::dropIfExists('fara_emv_trans_raw_trans');
        Schema::dropIfExists('fara_raw_transaction');
    }
};
