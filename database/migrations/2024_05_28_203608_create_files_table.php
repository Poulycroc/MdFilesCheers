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
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignId('author_id');

            $table->string('name');
            $table->string('size');

            $table->tinyInteger('visibility')->default(0); // 0 = Private, 1 = Public.
            $table->smallInteger('status')->default(5); // 5 = Draft State upon creation.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
