<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCoinConversionsTable
 */
class CreateCoinConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('coin_conversions', function (Blueprint $table) {
            $table->id();
            $table->string('origin');
            $table->string('destiny');
            $table->float('price');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['origin', 'destiny']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('coin_conversions');
    }
}
