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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->string('homepage')->nullable();
            $table->string('comment',6000);
            $table->string('pathImage',1280)->nullable();
            $table->boolean('isMain');
            $table->unsignedInteger('numberInCascade')->nullable();
            $table->unsignedInteger('idMainComment')->nullable();
            $table->unsignedInteger('inputIdPreviewComment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
