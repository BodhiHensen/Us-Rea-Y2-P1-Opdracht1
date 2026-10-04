<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Magazijn', function (Blueprint $table) {
            $table->smallIncrements('Id');
            $table->unsignedSmallInteger('ProductId');
            $table->decimal('VerpakkingsEenheid', 4, 1);
            $table->unsignedInteger('AantalAanwezig')->nullable();
            $table->boolean('IsActief')->default(true);
            $table->string('Opmerkingen', 250)->nullable();
            $table->dateTime('DatumAangemaakt', 6)->useCurrent();
            $table->dateTime('DatumGewijzigd', 6)->useCurrent()->useCurrentOnUpdate();

            $table->foreign('ProductId')
                ->references('Id')
                ->on('Product')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Magazijn');
    }
};
