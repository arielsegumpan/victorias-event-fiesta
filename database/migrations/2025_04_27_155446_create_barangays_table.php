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
        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('brgy_name')->unique();
            $table->string('brgy_slug')->unique()->index();
            $table->string('brgy_logo')->nullable();
            $table->json('brgy_img_gallery')->nullable();
            $table->longText('brgy_desc')->nullable();
            $table->foreignIdFor(User::class, 'created_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->boolean('is_published')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangays');
    }
};
