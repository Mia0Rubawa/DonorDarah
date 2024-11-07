<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Akun\Individu as AkunIndividu;

class KelurahanDesa extends Model
{
    use HasFactory;
    protected $table = 'reg_villages';
    protected $fillable = [''];


    public function provinsi()
    {
        return $this->belongsTo(Kecamatan::class, 'district_id', 'id');
    }
    public function all_akun_individu()
    {
        return $this->hasMany(AkunIndividu::class, 'kelurahan_desa_id', 'id');
    }
    public function single_akun_individu()
    {
        return $this->hasMany(AkunIndividu::class, 'kelurahan_desa_id', 'id');
    }
}
