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
        Schema::create('client_detail_speciality', function (Blueprint $table) {
            $table->foreignId('client_detail_id')->constrained()->cascadeOnDelete();
            $table->foreignId('speciality_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['client_detail_id', 'speciality_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_detail_speciality');
    }
};
