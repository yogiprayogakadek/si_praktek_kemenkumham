<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $guarded = ['id'];

    public function mahasiswa() 
    {
        return $this->hasOne(Mahasiswa::class, 'id', 'mahasiswa_id');
    }

    public function divisi() 
    {
        return $this->hasOne(Divisi::class, 'id', 'divisi_id');
    }
}
