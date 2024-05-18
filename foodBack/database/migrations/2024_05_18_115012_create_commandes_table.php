<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_plat')->unsigned();
            $table->integer('id_users')->unsigned();
            $table->string('nom_plat');
            $table->decimal('prix_plat', 10, 2);
            $table->json('accompagnement');
            $table->decimal('total_commande', 10, 2);
            $table->timestamp('dateCommande')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
