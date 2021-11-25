<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAboutCompanyToCompanyOverviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_overviews', function (Blueprint $table) {
              $table->text('about_company')->nullable()->after('data');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_overviews', function (Blueprint $table) {
            $table->dropColumn(['about_company']);
        });
       
    }
}
