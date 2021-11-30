<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyFactoryTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_factory_tour', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_profile_id')->nullable();
            $table->text('virtual_tour')->nullable();
            $table->text('factory_images')->nullable();
            $table->text('factory_large_images')->nullable();
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
        Schema::dropIfExists('company_factory_tour');
    }
}
