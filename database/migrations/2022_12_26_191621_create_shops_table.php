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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('contact_person_name');
            $table->string('products');
            $table->string('contact_no_1');
            $table->string('contact_no_2');
            $table->string('email');
            $table->string('shop_address');
            $table->string('shop_opening_time');
            $table->string('shop_closing_time');
            $table->boolean('delivery')->default(0);
            $table->date('registration_from');
            $table->date('registration_till');
            $table->integer('register_agent');
            $table->text('shop_location')->nullable();
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
        Schema::dropIfExists('shops');
    }
};
