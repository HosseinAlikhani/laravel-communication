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
        Schema::create('communications', function (Blueprint $table) {
            $table->id();
            $table->integer('service_type');
            $table->integer('port_type');
            $table->morphs('model');
            $table->json('template')->nullable();
            $table->integer('template_id')->nullable();
            $table->integer('template_data');
            $table->timestamp('send_at')->nullable();
            $table->timestamp('delivery_at')->nullable();
            $table->integer('try')->default(0);
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
