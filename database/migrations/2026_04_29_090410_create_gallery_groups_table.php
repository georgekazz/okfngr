<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration {
    public function up(): void
    {
        Schema::create('gallery_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date');
            $table->timestamps();
        });
 
        Schema::create('gallery_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('gallery_groups')->cascadeOnDelete();
            $table->string('path');
            $table->string('caption')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('gallery_photos');
        Schema::dropIfExists('gallery_groups');
    }
};