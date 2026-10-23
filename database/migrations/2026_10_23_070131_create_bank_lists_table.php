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
        Schema::create('bank_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type')->comment('1=debit, 2=credit, 3=both');
            $table->string('branch')->nullable();
            $table->decimal('credit_limit', 12, 2)->default(0);
            $table->string('waiver_condition')->nullable();
            $table->string('waiver_type')->comment('1=transaction, 2=amount')->nullable();
            $table->string('bank_logo')->nullable();
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
        Schema::dropIfExists('bank_lists');
    }
};
