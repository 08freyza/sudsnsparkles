<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->string('service_id')->primary();
            $table->string('name');
            $table->string('service_cat_id');
            $table->decimal('price', 8, 2);
            $table->enum('unit', ['kg', 'pcs', 'meter', 'package']);
            $table->timestamps();

            $table->foreign('service_cat_id')->references('service_cat_id')->on('service_categories')->onDelete('cascade')->constraint('services_service_cat_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign('services_service_cat_id_foreign');
        });
        Schema::dropIfExists('services');
    }
}
