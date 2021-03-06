<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_plan', function (Blueprint $table) {
            $table->unsignedBigInteger('feature_id');
            $table->unsignedBigInteger('plan_id');
        });

        Schema::table('feature_plan', function (Blueprint $table) {
            $table->foreign('feature_id')->references('id')->on('features');
            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feature_plan', function (Blueprint $table) {
            $table->dropForeign(['feature_id']);
            $table->dropForeign(['plan_id']);
        });
        Schema::dropIfExists('feature_plan');
    }
}
