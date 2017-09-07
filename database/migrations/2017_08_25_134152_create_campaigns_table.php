<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usermail');
            $table->string('title');
            $table->longText('story');
            //original fund = 100 / 105 * actual fund
            $table->decimal('actual_fund', 15, 2);
            $table->decimal('collected', 15, 2);
            $table->timestamps();

            //set foreign key with 'on delete cascade'
            $table->foreign('usermail')->references('email')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
