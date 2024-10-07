<?php

namespace App\Models;

use Filament\Panel;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if the user has a specific role.
     *
     * @param string|array $roles The role(s) to check
     * @return bool
     */
    public function hasRole($roles): bool
    {
        $roles = is_array($roles) ? $roles : [$roles];
        return in_array($this->role, $roles);
    }

    /**
     * Check if the user can access a specific panel.
     *
     * @param Panel $panel The panel to check access for
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // /**
    //  * Create user code
    //  */
    // public function generateUserCode(): string
    // {
    //     return $this->generateUniqueCode(6);
    // }

    // private function generateUniqueCode(int $length): string
    // {
    //     do {
    //         $userCode = $this->generateRandomCode($length);
    //         $exists = DB::table('users')->where('user_code', $userCode)->exists();
    //     } while ($exists);
    //     return $userCode;
    // }

    // private function generateRandomCode(int $length): string
    // {
    //     $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //     $charactersLength = strlen($characters);
    //     $randomCode = '';

    //     for ($i = 0; $i < $length; $i++) {
    //         $randomCode .= $characters[random_int(0, $charactersLength - 1)];
    //     }

    //     return $randomCode;
    // }

}
