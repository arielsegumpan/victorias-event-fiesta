<?php

use App\Models\User;
use App\Models\Fiesta;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(Fiesta::class, 'fiesta_id')->constrained('fiestas')->cascadeOnDelete();
            $table->integer('rating')->default(0);
            $table->longText('review')->nullable();
            $table->json('review_images')->nullable();
            $table->string('review_title')->nullable()->unique();
            $table->string('review_slug')->nullable()->unique()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
