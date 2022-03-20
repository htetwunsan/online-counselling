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
        Schema::create('counsellor_detail_prefer_language', function (Blueprint $table) {
            $table->foreignId('counsellor_detail_id')->constrained()->cascadeOnDelete();
            $table->foreignId('prefer_language_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['counsellor_detail_id', 'prefer_language_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counsellor_detail_prefer_language');
    }
};
