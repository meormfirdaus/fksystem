<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parking_spaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parking_area_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('space_no');      // A1-001
            $table->uuid('qr_token')->unique();
            $table->enum('status',[
                'available',
                'occupied',
                'out_of_service'
            ])->default('available');

            $table->timestamps();
            $table->unique(['parking_area_id','space_no']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parking_spaces');
    }
};
