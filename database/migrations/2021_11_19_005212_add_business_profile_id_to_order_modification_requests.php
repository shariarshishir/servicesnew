<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinessProfileIdToOrderModificationRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_modification_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('business_profile_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_modification_requests', function (Blueprint $table) {
            $table->dropColumn('business_profile_id');
        });
    }
}
