<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'reg_provinces';
    protected $fillable = [''];


    public function all_kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'province_id', 'id');
    }
    public function single_kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'province_id', 'id');
    }
}
