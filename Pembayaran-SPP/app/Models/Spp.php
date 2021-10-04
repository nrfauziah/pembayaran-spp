<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;
    protected $table = 'spp';
    protected $guarded  = ['_token'];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'spp_id' ,'id');
    }
}
