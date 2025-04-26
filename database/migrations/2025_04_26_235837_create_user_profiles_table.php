<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Woenel\Prpcmblmts\Models\PhilippineCity;
use Illuminate\Database\Migrations\Migration;
use Woenel\Prpcmblmts\Models\PhilippineRegion;
use Woenel\Prpcmblmts\Models\PhilippineBarangay;
use Woenel\Prpcmblmts\Models\PhilippineProvince;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact_number')->nullable();
            $table->foreignIdFor(PhilippineRegion::class, 'region_id')->nullable()->constrained('philippine_regions')->cascadeOnDelete();
            $table->foreignIdFor(PhilippineProvince::class, 'province_id')->nullable()->constrained('philippine_provinces')->cascadeOnDelete();
            $table->foreignIdFor(PhilippineCity::class, 'city_id')->nullable()->constrained('philippine_cities')->cascadeOnDelete();
            $table->foreignIdFor(PhilippineBarangay::class, 'barangay_id')->nullable()->constrained('philippine_barangays')->cascadeOnDelete();
            $table->string('street')->nullable();
            $table->string('full_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
