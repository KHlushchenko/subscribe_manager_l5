<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubscribeManagerMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vis_subscribers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email', 255);
            $table->string('lang', 2);
            $table->tinyInteger('is_active')->default("1");
            $table->timestamps();
        });

        Schema::create('vis_subscribe_entities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->tinyInteger('is_active')->default("1");
            $table->timestamps();
        });


        Schema::create('vis_subscribers2vis_subscribe_entities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('subscriber_id')->unsigned();
            $table->integer('entity_id')->unsigned();

            $table->foreign('subscriber_id')->references('id')->on('vis_subscribers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('subscribe_entity_id')->references('id')->on('vis_subscribe_entities')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('vis_subscribers2vis_subscribe_entities');
        Schema::dropIfExists('vis_subscribers');
        Schema::dropIfExists('vis_subscribe_entities');
    }
}
