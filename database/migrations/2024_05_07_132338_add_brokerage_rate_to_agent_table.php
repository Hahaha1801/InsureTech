<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrokerageRateToAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->decimal('brokerage_rate', 6, 2)->nullable(false)->after('email')->comment('Brokerage rate of the agent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agent', function (Blueprint $table) {
            $table->dropColumn('brokerage_rate');
        });
    }
}
