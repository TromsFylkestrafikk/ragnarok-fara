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
        Schema::create('fara_arch', function (Blueprint $table)
        {
            $table->unsignedBigInteger('transactionida')->comment('Transaction ID. PS: Duplicates allowed');
            $table->timestamp('eventdatetime')->comment('Date/time of event');
            $table->unsignedBigInteger('operatorcompanyid')->comment('Reference: fara_company.companyid');
            $table->unsignedBigInteger('operatorid')->comment('Operator ID');
            $table->integer('producttemplateno')->comment('Reference: fara_basic_template.templateid');
            $table->smallInteger('customerprofileid')->comment('Reference: fara_customer_profile.custprofileid');
            $table->float('amount', 13, 4)->comment('Total amount');
            $table->float('vatamount', 13, 4)->comment('VAT');
            $table->smallInteger('numberofpassengers')->comment('Passenger count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fara_arch');
    }
};
