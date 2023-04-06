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
        Schema::create('blog_posts', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('content');
                $table->string('industry');
                $table->string('tone');
                $table->string('catchy_title');
                $table->string('catchy_description');
                $table->string('keywords');
                $table->string('meta_description');
                $table->integer('blog_length');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
