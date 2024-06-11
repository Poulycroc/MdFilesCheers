<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id');

            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');

            $table->string('name');
            $table->string('size');

            $table
                ->tinyInteger('visibility')
                ->default(File::VISIBILITY_PRIVATE);

            $table->smallInteger('status')->default(5); // 5 = Draft State upon creation.

            $table->uuid('folder_id')->nullable();
            $table->uuid('project_id')->nullable();

            $table->longText('content');
            $table->string('encrypted_passcode')->nullable();

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
