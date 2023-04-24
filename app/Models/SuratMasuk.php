<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    User,
    Disposisi
};

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function disposisi()
    {
        return $this->hasMany(Disposisi::class);
    }
}