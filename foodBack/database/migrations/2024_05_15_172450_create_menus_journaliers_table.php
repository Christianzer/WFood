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

        Schema::create('menus_journaliers', function (Blueprint $table) {
            $table->id('id_menus_journaliers');
            $table->string('date_menu');
            $table->unsignedBigInteger('id_plat');
            $table->json('id_accompagnement')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus_journaliers');
    }
};
