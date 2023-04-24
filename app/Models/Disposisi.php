<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    User,
    SuratMasuk
};

class Disposisi extends Model
{
    use HasFactory;

    protected $table = 'disposisi';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function suratmasuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'suratmasuk_id');
    }
}