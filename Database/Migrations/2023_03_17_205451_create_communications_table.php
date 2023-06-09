<?php

use D3cr33\Communication\Services\Service;
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
        Schema::create('communications', function (Blueprint $table) {
            $table->id();
            $table->integer('service');
            $table->integer('port');
            $table->morphs('model');
            $table->text('template')->nullable();
            $table->integer('template_id')->nullable();
            $table->json('template_data');
            $table->json('receiver_data');
            $table->timestamp('send_at')->nullable();
            $table->timestamp('delivery_at')->nullable();
            $table->integer('try')->default(0);
            $table->enum('thread', [Service::THREAD_SYNC, Service::THREAD_ASYNC]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communications');
    }
};
