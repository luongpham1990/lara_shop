<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//
//class CreateAllTable extends Migration
//{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        //
//        // Create users table
//        Schema::create('users', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('name', 50);
//            $table->string('username', 50);
//            $table->string('email')->unique();
//            $table->string('password');
//            $table->string('address');
//            $table->string('confirm_code', 100);
//            $table->tinyInteger('confirmed');
//            $table->rememberToken();
//            $table->timestamps();
//        });
//        // Create wishlists table
//        Schema::create('wishlists', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('user_id')->unsigned();
//            $table->integer('product_id')->unsigned();
//        });
//        // create orders table
//
//        Schema::create('orders', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('transaction_id')->unsigned();
//            $table->integer('product_id')->unsigned();
//            $table->integer('quantity');
//        });
//
//        // Create blogs table
//
//        Schema::create('blogs', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('title', 255);
//            $table->text('content');
//            $table->string('author', 255);
//            $table->dateTime('created_time');
//            $table->dateTime('last_edit_time');
//        });
//        // Create catalogs table
//
//        Schema::create('catalogs', function (Blueprint $hh) {
//            $hh->increments('catalog_id');
//            $hh->string('catalog_name', 255);
//        });
//
//        //Create prices table
//
//        Schema::create('prices', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('product_id')->unsigned();
//            $table->integer('price');
//            $table->dateTime('start_at');
//            $table->dateTime('end_at');
//        });
//
//        //Create transactions table
//
//        Schema::create('transactions', function (Blueprint $table) {
//            $table->increments('id');
//            $table->tinyInteger('status');
//            $table->integer('user_id')->unsigned();
//            $table->integer('amount');
//            $table->string('payment', 32);
//            $table->string('message', 255);
//            $table->dateTime('transaction_date_time');
//        });
//        // create products table
//
//        Schema::create('products', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('catalog_id')->unsigned();
//            $table->string('product_name', 255);
//            $table->integer('price');
//            $table->text('description');
//            $table->integer('view');
//            $table->tinyInteger('review');
//            $table->string('brand', 32);
//        });
//
//        // create product_photos table
//
//        Schema::create('product_photos', function (Blueprint $table) {
//            $table->increments('product_photo_id');
//            $table->string('thumbnail_photo_link', 255);
//            $table->string('thumbnail_photo_name', 255);
//            $table->date('modify_date');
//        });
//
//        // create discount table
//
//        Schema::create('discount', function (Blueprint $table) {
//            $table->increments('id');
//            $table->string('discount_name', 255);
//            $table->string('sale_type');
//            $table->integer('value');
//            $table->integer('product_id')->unsigned();
//
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
//
//        });
//
//        // create product_product_photo table
//
//        Schema::create('product_product_photo', function (Blueprint $table) {
//            $table->integer('product_photo_id')->unsigned();
//            $table->integer('product_id')->unsigned();
//            $table->date('modify_date');
//
//            $table->foreign('product_photo_id')->references('product_photo_id')->on('product_photos')->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
//        });
//
//
//        // create foreign key
//
//        Schema::table('prices', function (Blueprint $table) {
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
//        });
//
//        Schema::table('orders', function (Blueprint $table) {
//            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
//
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
//
//        });
//
//        Schema::table('transactions', function(Blueprint $table){
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
//        });
//
//        Schema::table('products', function(Blueprint $table){
//            $table->foreign('catalog_id')->references('catalog_id')->on('catalogs')->onDelete('cascade')->onUpdate('cascade');
//        });
//        Schema::table('wishlists', function(Blueprint $table){
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
//        });
//
//
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        //
//    }
//}

// Database Thanh
class CreateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Create users table

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->integer('phone',15); // Thanh sửa từ : string('numberphone',15).
            $table->string('confirm_code',100);
            $table->tinyInteger('confirmed');
            $table->tinyInteger('is_admin')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });


        // Create wishlists table

        Schema::create('wishlists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
        });


        // create orders table

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id')->unsigned();
            $table->integer('discount_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity');
            $table->integer('current_price');
        });

        // Create blogs table

        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('content');
            $table->string('author', 255);
            $table->dateTime('created_time')->nullable();
            $table->dateTime('last_edit_time')->nullable();
        });

        // Create catalogs table

        Schema::create('catalogs', function (Blueprint $hh) {
            $hh->increments('catalog_id');
            $hh->string('catalog_name', 255);
        });

        //Create transactions table

        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status');
            $table->integer('user_id')->unsigned();
            $table->integer('amount');
            $table->string('payment', 32);
            $table->string('message', 255);
            $table->dateTime('transaction_date_time')->nullable();
        });

        // create products table

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('catalog_id')->unsigned();
            $table->string('product_name', 255);
            $table->integer('price');
            $table->text('description');
            $table->integer('view')->nullable();
            $table->tinyInteger('review')->nullable();
            $table->string('brand', 32);
            $table->tinyInteger('status');
            $table->timestamps();
        });

        // create product_photos table

        Schema::create('product_photos', function (Blueprint $table) {
            $table->increments('product_photo_id');
            $table->string('thumbnail_photo_link', 255);
            $table->string('thumbnail_photo_name', 255);
        });

        // create discount table

        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('discount_name', 255);
            $table->string('sale_type');
            $table->integer('value');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
        });

        // create product_product_photo table

        Schema::create('product_product_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_photo_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_photo_id')->references('product_photo_id')->on('product_photos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });


        // create foreign key

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('transactions', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('products', function(Blueprint $table){
            $table->foreign('catalog_id')->references('catalog_id')->on('catalogs')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('wishlists', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Thử drop bảng

        // Schema::table('transactions', function(Blueprint $table){
        //     // $table->dropForeign(['user_id']);
        //     $table->dropForeign('user_id');
        // });
        // Schema::table('wishlists', function(Blueprint $table){
        //     $table->dropForeign('user_id');
        //     $table->dropForeign('product_id');
        // });
        // Schema::table('orders', function(Blueprint $table){
        //     // $table->dropForeign(['transaction_id','product_id','discount_id']);
        //     $table->dropForeign('transaction_id');
        //     $table->dropForeign('product_id');
        //     $table->dropForeign('discount_id');
        // });
        // Schema::table('products', function(Blueprint $table){
        //     // $table->dropForeign(['catalog_id']);
        //     $table->dropForeign('catalog_id');
        // });
        // Schema::table('discounts', function(Blueprint $table){
        //     $table->dropForeign('product_id');
        // });
        // Schema::table('product_product_photos', function(Blueprint $table){
        //     // $table->dropForeign(['product_photo_id','product_id']);
        //     $table->dropForeign('product_photo_id');
        //     $table->dropForeign('product_id');
        // });
        // Schema::dropIfExists('users');
        // Schema::dropIfExists('wishlists');
        // Schema::dropIfExists('blogs');
        // Schema::dropIfExists('catalogs');
        // Schema::dropIfExists('transactions');
        // Schema::dropIfExists('orders');
        // Schema::dropIfExists('products');
        // Schema::dropIfExists('product_photos');
        // Schema::dropIfExists('discounts');
        // Schema::dropIfExists('product_product_photos');

    }
}
