<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_information', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText("description");
        });

        Schema::table("list_information", function(Blueprint $table) {
            $table->foreignId("cover_information_id")->constrained("cover_information")->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_information');
    }
}
