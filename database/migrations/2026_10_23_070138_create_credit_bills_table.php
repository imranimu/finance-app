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
        Schema::create('credit_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_list_id')->constrained('bank_lists')->cascadeOnDelete();
            $table->decimal('bill_amount', 12, 2);
            $table->decimal('min_amount', 12, 2);
            $table->date('bill_date');
            $table->date('last_date');
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
        Schema::dropIfExists('credit_bills');
    }
};
