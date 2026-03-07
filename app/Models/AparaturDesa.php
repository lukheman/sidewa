<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AparaturDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jabatan',
        'nip',
        'foto',
        'urutan',
    ];
}
