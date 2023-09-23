<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundrySystemTables extends Migration
{
    public function up()
    {
        // Schema::create('admins', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->text('address')->nullable();
        //     $table->text('latitude')->nullable();
        //     $table->text('longitude')->nullable();
        //     $table->string('phone_number', 20)->nullable();
        //     $table->string('username')->unique();
        //     $table->string('email')->nullable();
        //     $table->string('password', 100);
        //     $table->timestamps();
        // });

        // Schema::create('customers', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->text('address')->nullable();
        //     $table->text('latitude')->nullable();
        //     $table->text('longitude')->nullable();
        //     $table->string('phone_number', 20)->nullable();
        //     $table->string('username')->unique();
        //     $table->string('email')->nullable();
        //     $table->string('password', 100);
        //     $table->timestamps();
        // });

        // Schema::create('service_categories', function (Blueprint $table) {
        //     $table->string('service_cat_id')->primary();
        //     $table->text('name');
        //     $table->timestamps();
        // });

        // Schema::create('services', function (Blueprint $table) {
        //     $table->string('service_id')->primary();
        //     $table->string('name');
        //     $table->string('service_cat_id');
        //     $table->decimal('price', 8, 2);
        //     $table->enum('unit', ['kg', 'pcs', 'meter', 'package']);
        //     $table->timestamps();

        //     $table->foreign('service_cat_id')->references('service_cat_id')->on('service_categories')->onDelete('cascade')->constraint('services_service_cat_id_foreign');
        // });

        // Schema::create('orders', function (Blueprint $table) {
        //     $table->string('order_id')->primary();
        //     $table->unsignedBigInteger('customer_id');
        //     $table->dateTime('order_date')->nullable();
        //     $table->enum('use_delivery', ['Y', 'N']);
        //     $table->dateTime('pickup_date')->nullable();
        //     $table->dateTime('delivery_date')->nullable();
        //     $table->enum('status', ['picking_up', 'in_progress', 'on_shipping', 'unpaid', 'done', 'cancelled']);
        //     $table->timestamps();

        //     $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->constraint('orders_customer_id_foreign');
        // });

        // Schema::create('order_details', function (Blueprint $table) {
        //     $table->string('order_id');
        //     $table->string('service_id');
        //     $table->integer('quantity');
        //     $table->decimal('subtotal', 11, 2);
        //     $table->timestamps();

        //     $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade')->constraint('order_details_order_id_foreign');
        //     $table->foreign('service_id')->references('service_id')->on('services')->onDelete('cascade')->constraint('order_details_service_id_foreign');
        // });

        // Schema::create('payments', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('order_id');
        //     $table->decimal('amount', 8, 2);
        //     $table->dateTime('payment_date')->nullable();
        //     $table->timestamps();

        //     $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        // });

        // Schema::create('reviews', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('customer_id');
        //     $table->string('order_id');
        //     $table->integer('rating')->nullable();
        //     $table->text('comment')->nullable();
        //     $table->timestamps();

        //     $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->constraint('reviews_customer_id_foreign');
        //     $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade')->constraint('reviews_order_id_foreign');
        // });
    }

    public function down()
    {
        // Schema::table('reviews', function (Blueprint $table) {
        //     $table->dropForeign('reviews_customer_id_foreign');
        //     $table->dropForeign('reviews_order_id_foreign');
        // });
        // Schema::table('order_details', function (Blueprint $table) {
        //     $table->dropForeign('order_details_order_id_foreign');
        //     $table->dropForeign('order_details_service_id_foreign');
        // });
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->dropForeign('orders_customer_id_foreign');
        // });
        // Schema::table('services', function (Blueprint $table) {
        //     $table->dropForeign('services_service_cat_id_foreign');
        // });
        // Schema::dropIfExists('reviews');
        // Schema::dropIfExists('order_details');
        // Schema::dropIfExists('orders');
        // Schema::dropIfExists('services');
        // Schema::dropIfExists('service_categories');
        // Schema::dropIfExists('customers');
        // Schema::dropIfExists('admins');
    }
}
