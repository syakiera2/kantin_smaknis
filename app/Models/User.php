<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;   // <--- Tambahkan ini
use Illuminate\Database\Eloquent\Relations\HasMany; // <--- Tambahkan ini
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'saldo', 'foto_profil'];

    protected $hidden = ['password', 'remember_token'];

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
    
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    public function topUps(): HasMany
    {
        return $this->hasMany(TopUp::class);
    }

    public function siswa() { return $this->hasOne(Siswa::class); }
    public function guru() { return $this->hasOne(Guru::class); }
    public function penjual() { return $this->hasOne(Penjual::class); }
}