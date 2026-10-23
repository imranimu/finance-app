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
        Schema::create('emi_lists', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_amount', 12, 2);
            $table->decimal('installment', 12, 2);
            $table->integer('total_month');
            $table->integer('paid_month')->default(0);
            $table->decimal('due', 12, 2)->default(0);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('emi_date');
            $table->text('descriptions')->nullable();
            $table->foreignId('emi_person_id')->constrained('emi_people')->cascadeOnDelete();
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
        Schema::dropIfExists('emi_lists');
    }
};
