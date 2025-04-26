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
        Schema::table('fiesta_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fiesta_id')->constrained('fiestas')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fiesta_tag', function (Blueprint $table) {
            $table->dropForeign(['fiesta_id']);
            $table->dropForeign(['tag_id']);
            $table->dropColumn('fiesta_id');
            $table->dropColumn('tag_id');
        });
    }
};
