<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;

class Siswa extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, HasFactory, Notifiable;
    use HasFactory;
    protected $table = 'siswa';
    protected $guarded  = ['_token'];
    protected $hidden = ['password'];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'kelas_id');
    }
    public function transaksi()
    {
        return $this->hasMany(Pembayaran::class, 'siswa_id','id');
    }
}
