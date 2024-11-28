<?php

// database/migrations/xxxx_xx_xx_create_cakes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCakesTable extends Migration
{
    public function up()
    {
        Schema::create('cakes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('size'); // e.g., Small, Medium, Large
            $table->string('image')->default('img/cake/1.jpg'); // Ganti default sesuai kebutuhan
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cakes');
    }
}
