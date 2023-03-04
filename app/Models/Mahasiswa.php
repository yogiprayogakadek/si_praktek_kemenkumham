<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $guarded = ['id'];

    public function pendaftaran() 
    {
        return $this->belongsTo(Pendaftaran::class, 'id', 'mahasiswa_id');
        // return $this->belongsTo(Pendaftaran::class, 'mahasiswa_id', 'id');
    }
}
