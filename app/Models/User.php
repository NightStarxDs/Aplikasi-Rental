<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'name',
        'email',
        'telepon',
        'alamat',
        'password',
        'role',
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
    // ──────────────────────────────────────
    // ACCESSOR — Format ID tampil: USR001
    // ──────────────────────────────────────
    public function getFormattedIdAttribute(): string
    {
        return 'USR' . str_pad($this->id_user, 3, '0', STR_PAD_LEFT);
    }

    // ──────────────────────────────────────
    // HELPER — Cek apakah user adalah admin
    // ──────────────────────────────────────
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // ──────────────────────────────────────
    // RELASI — ke tabel orders (riwayat)
    // Sesuaikan dengan model Order Anda
    // ──────────────────────────────────────
    public function Rental()
    {
        return $this->hasMany(Rental::class, 'id_user', 'id_user');
    }
}
