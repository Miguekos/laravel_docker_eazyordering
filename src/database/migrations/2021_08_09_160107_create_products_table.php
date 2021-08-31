<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('warehouse_id')->references('id')->on('users');
            $table->string('category')->nullable();
            $table->string('family')->nullable();
            $table->string('description_en');
            $table->string('description_es')->nullable();
            $table->string('description_it')->nullable();
            $table->string('unit_weight')->nullable();
            $table->string('total_weight')->nullable();
            $table->integer('pieces')->nullable();
            $table->string('uom')->nullable();
            $table->string('pack_description')->nullable();
            $table->string('photo')->nullable();
            $table->string('stock')->nullable();
            $table->boolean('availability')->default(1);
            $table->date('availability_date')->nullable();
            $table->decimal('unit_price');
            $table->decimal('total_price');
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
        Schema::dropIfExists('products');
    }
}
