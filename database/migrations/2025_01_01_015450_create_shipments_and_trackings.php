<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->string('awb_number')->unique();
            $table->string('status')->nullable();
            $table->text('location')->nullable();
            $table->timestamps();
        });

        Schema::create('senders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tracking_id');
            $table->string('name');
            $table->string('street_address');
            $table->string('city');
            $table->string('postal_code');
            $table->string('country');
            $table->string('no_handphone');
            $table->timestamps();

            $table->foreign('tracking_id')->references('id')->on('trackings')->onDelete('cascade');
        });

        Schema::create('receivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tracking_id');
            $table->string('name');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country');
            $table->string('no_handphone');
            $table->timestamps();

            $table->foreign('tracking_id')->references('id')->on('trackings')->onDelete('cascade');
        });

        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tracking_id');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->string('type');
            $table->string('package_description');
            $table->float('weight');
            $table->float('quantity');
            $table->float('height');
            $table->float('width');
            $table->float('length');
            $table->timestamps();

            $table->foreign('tracking_id')->references('id')->on('trackings')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('senders')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('receivers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('trackings');
        Schema::dropIfExists('shipments');
        Schema::dropIfExists('receivers');
        Schema::dropIfExists('senders');
    }
};
