<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('c_name');
            $table->string('group');
            $table->string('address');
            $table->string('mobile_no');
            $table->string('insurer_name');
            $table->string('p_type');
            $table->string('p_name');
            $table->string('p_number')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('sub_ins');
            $table->integer('premium');
            $table->integer('tp_motor');
            $table->integer('basic');
            $table->integer('terr');
            $table->integer('eq');
            $table->integer('other');
            $table->integer('stfi');
            $table->integer('gst');
            $table->date('receipt_date');
            $table->integer('total');
            $table->longtext('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policies');
    }
}
