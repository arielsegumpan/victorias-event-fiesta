<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\UserProfile;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function userProfile() : HasOne
    {
        return $this->hasOne(UserProfile::class);
    }


    public function canAccessPanel(Panel $panel): bool
    {
        // Get the user and their roles for debugging
        $user = Auth::user();
        $roles = $user ? $user->getRoleNames()->toArray() : [];
        $panelId = $panel->getId();

        if ($panelId === 'admin' || 'auth' && $user && $user->hasRole('super_admin')) {
            return true;
        }

        if ($panelId === 'fiesta' || 'auth' && $user && $user->hasRole('fiesta')) {
            return true;
        }

        return false;
    }

    public function usersPanel(): string
    {
        $role = $this->getRoleNames()->first(); // uses Spatie's HasRoles trait

        return match ($role) {
            'super_admin' => url(Filament::getPanel('admin')->getPath()),
            'fiesta' => url(Filament::getPanel('fiesta')->getPath()),
            default => '/', // fallback URL
        };
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
