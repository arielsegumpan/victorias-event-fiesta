<?php

use App\Models\Fiesta;
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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(Fiesta::class,'fiesta_id')->constrained('fiestas')->cascadeOnDelete();
            $table->longText('comment')->nullable();
            $table->json('comment_imgs')->nullable();
            $table->boolean('is_approved')->default(0);
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
