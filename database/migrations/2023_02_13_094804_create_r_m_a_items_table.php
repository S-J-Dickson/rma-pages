<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rma_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rma_id');
            $table->string('type');
            $table->string('value');
            $table->string('identifier')->nullable();
            $table->string('reason');
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
        Schema::dropIfExists('rma_items');
    }
};
