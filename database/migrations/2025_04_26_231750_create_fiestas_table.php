<?php

use App\Models\User;
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
        Schema::create('fiestas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('f_name')->unique();
            $table->string('f_slug')->unique()->index();
            $table->json('f_image')->nullable();
            $table->longText('f_description')->nullable();
            $table->dateTime('f_start_date')->nullable();
            $table->dateTime('f_end_date')->nullable();
            $table->json('f_location')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_approved')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiestas');
    }
};
