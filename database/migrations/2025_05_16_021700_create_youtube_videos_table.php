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
        Schema::create('youtube_videos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('description');
            $table->string('video_id')->unique();
            $table->dateTime('published_at')->nullable()->comment('YouTube video publication date');
            $table->uuid('service_id')->nullable();
            $table->uuid('branch_id')->nullable()->comment('Brand associated with the video');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('restrict');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('restrict');
            $table->boolean('status')->default(true)->comment('Status of the video (active/inactive)');
            $table->boolean('featured')->default(false)->comment('Featured video status');
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->softDeletes()->comment('Soft delete timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youtube_videos');
    }
};
