<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productsoffre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offre_id');  
            $table->unsignedBigInteger('produit_id'); 
            $table->timestamps();
    
            $table->foreign('produit_id')->references('id')->on('produits')->onDelete('cascade');
            $table->foreign('offre_id')->references('id')->on('offres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productsoffre');
    }
};
