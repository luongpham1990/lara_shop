<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTableFinal extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('phone',15)->nullable();
            $table->string('confirm_code',100)->nullable();
            $table->tinyInteger('confirmed');
            $table->tinyInteger('is_admin')->nullable();
            $table->string('social_id')->nullable();
            $table->string('avatar')->nullable();
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

        // Create cateblogs table

        Schema::create('cateblogs', function(Blueprint $table){
                    $table->increments('id');
                    $table->string('name')->unique();
                    $table->string('slug');
                    $table->text('description')->nullable();
                    $table->string('image')->default('/img/NOIMAGE.JPG');
                    $table->timestamps();
                });

        // Create posts table

         Schema::create('posts', function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer('author_id')->unsigned()->default(0);
                    $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
                    $table->integer('category_id')->unsigned()->default(0);
                    $table->foreign('category_id')->references('id')->on('cateblogs')->onDelete('cascade')->onUpdate('cascade');
                    $table->string('banner')->default('/img/noimage.jpg');
                    $table->string('title')->unique();
                    $table->text('body');
                    $table->string('slug')->unique();
                    $table->boolean('active');
                    $table->dateTime('last_edit_time')->nullable();
                    $table->timestamps();
         });

         // Create comments table

           Schema::create('comments', function (Blueprint $table) {
                     $table->increments('id');
                     $table->integer('on_post')->unsigned()->default(0);
                     $table->foreign('on_post')->references('id')->on('posts')->onDelete('cascade');
                     $table->integer('from_user')->unsigned()->default(0);
                     $table->foreign('from_user')->references('id')->on('users')->onDelete('cascade');
                     $table->text('body');
                     $table->timestamps();
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
        // Schema::dropIfExists('catalogs');
        // Schema::dropIfExists('transactions');
        // Schema::dropIfExists('orders');
        // Schema::dropIfExists('products');
        // Schema::dropIfExists('product_photos');
        // Schema::dropIfExists('discounts');
        // Schema::dropIfExists('product_product_photos');

    }
}
?>