<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\Comments;
use App\Models\UserProfile;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $user = Auth::user();
        $panelId = $panel->getId();

        return match ($panelId) {
            'admin' => $user && $user->hasRole('super_admin'),
            'fiesta' => $user && $user->hasAnyRole(['barangay captain', 'barangay_captain' , 'brgy captain', 'brgy_captain', 'captain']),
            default => true, // allow 'auth' or fallback
        };
    }

    public function usersPanel(): string
    {
        $role = $this->getRoleNames()->first();

        return match ($role) {
            'super_admin' => Filament::getPanel('admin')->getUrl(),
             'victoriasanon' => redirect()->route('home.page'),
            'barangay captain' => Filament::getPanel('fiesta')->getUrl(),
            'barangay_captain' => Filament::getPanel('fiesta')->getUrl(),
            'brgy captain' => Filament::getPanel('fiesta')->getUrl(),
            'brgy_captain' => Filament::getPanel('fiesta')->getUrl(),
            'captain' => Filament::getPanel('fiesta')->getUrl(),
            default => Filament::getPanel('auth')->getUrl(),
        };
    }

    public function userProfile() : HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comments::class);
    }

    public function captainRoles()
    {
        return $this->hasMany(BarangayCaptain::class);
    }

    public function currentBarangay()
    {
        return $this->hasOne(BarangayCaptain::class)
                    ->whereNull('term_end')
                    ->orWhere('term_end', '>=', now());
    }


    // Relationships
    public function createdBarangays(): HasMany
    {
        return $this->hasMany(Barangay::class, 'created_by');
    }

    public function captainOf(): HasMany
    {
        return $this->hasMany(BarangayCaptain::class, 'user_id');
    }

    public function createdFiestas(): HasMany
    {
        return $this->hasMany(Fiesta::class, 'created_by');
    }


}
