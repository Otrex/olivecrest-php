<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan')->nullable();
            $table->unsignedDecimal('available_balance', 60, 2)->default(0);
            $table->unsignedDecimal('total_balance', 60, 2)->default(0);
            $table->unsignedDecimal('invested_balance', 60, 2)->default(0);
            $table->unsignedDecimal('referal_bonus', 60, 2)->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plan')->references('id')->on('investment_plans');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}