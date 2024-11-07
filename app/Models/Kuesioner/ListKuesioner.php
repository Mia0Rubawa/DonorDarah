<?php

namespace App\Models\Kuesioner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKuesioner extends Model
{
    use HasFactory;
    protected $table = 'kuesioner_pasien';
    protected $fillable = [''];

}
