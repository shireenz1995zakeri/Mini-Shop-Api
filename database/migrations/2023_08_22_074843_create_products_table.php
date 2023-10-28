<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id')->nullable()->comment('is writer')->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->cacadeOndelete();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
           // $table->string('title');
           // $table->text('body');
            $table->unsignedBigInteger('inventory')->default(0)->comment('موجودی');
            $table->boolean('published')->default(0);
            $table->decimal('price');
            $table->softDeletes();
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
};
