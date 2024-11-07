<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'reg_district';
    protected $fillable = [''];


    public function provinsi()
    {
        return $this->belongsTo(Kabupaten::class, 'regency_id', 'id');
    }
    public function all_kecamatan()
    {
        return $this->hasMany(KelurahanDesa::class, 'district_id', 'id');
    }
    public function single_kecamatan()
    {
        return $this->hasMany(KelurahanDesa::class, 'district_id', 'id');
    }
}
