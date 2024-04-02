<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferedByToPoliciesTable extends Migration
{
    public function up()
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->unsignedBigInteger('refered_by')->nullable();
            $table->foreign('refered_by')->references('id')->on('agents')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->dropForeign(['refered_by']);
            $table->dropColumn('refered_by');
        });
    }
}
