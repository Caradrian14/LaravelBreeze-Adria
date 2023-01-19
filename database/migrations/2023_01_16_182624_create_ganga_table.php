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
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->timestamps();
        });
        Schema::create('ganga', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('url');
            $table->integer("likes")->default(0);
            $table->integer("unlikes")->default(0);
            $table->float("price");
            $table->float("price_sale");
            $table->boolean("available")->default(false);

            $table->unsignedBigInteger("category");
            $table->unsignedBigInteger("user_id");

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category')->references('id')->on('category');
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
        Schema::dropIfExists('category');
        Schema::dropIfExists('ganga');
    }
};
