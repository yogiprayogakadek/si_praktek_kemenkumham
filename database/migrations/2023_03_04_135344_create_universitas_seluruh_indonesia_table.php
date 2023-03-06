<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universitas_seluruh_indonesia', function (Blueprint $table) {
            $table->id();
            $table->integer('ranking');
            $table->integer('world_rank');
            $table->string('university', 100);
            $table->integer('impact_rank');
            $table->integer('openness_rank');
            $table->integer('excellence_rank');
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
        Schema::dropIfExists('universitas_seluruh_indonesia');
    }
};
