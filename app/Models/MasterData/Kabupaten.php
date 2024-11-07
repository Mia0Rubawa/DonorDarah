<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'reg_regencies';
    protected $fillable = [''];


    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinces_id', 'id');
    }
    public function all_kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'regency_id', 'id');
    }
    public function single_kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'regency_id', 'id');
    }
}
