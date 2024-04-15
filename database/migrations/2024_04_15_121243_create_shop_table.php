<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop', function (Blueprint $table) {
            $table->id();
            $table->char('article', 10);
            $table->char('dealer', 10);
            $table->float('price');
        });

        DB::table('shop')->insert([
            ['article' => '0001', 'dealer' => 'B', 'price' => 3.99],
            ['article' => '0002', 'dealer' => 'A', 'price' => 10.99],
            ['article' => '0003', 'dealer' => 'C', 'price' => 1.69],
            ['article' => '0004', 'dealer' => 'D', 'price' => 19.95],
            ['article' => '0005', 'dealer' => 'E', 'price' => 21.05],
            ['article' => '0001', 'dealer' => 'A', 'price' => 3.32],
            ['article' => '0002', 'dealer' => 'D', 'price' => 10.99],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop');
    }
};
