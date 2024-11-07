<?php

namespace App\Models\Akun;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Individu extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'akun_individu';
    protected $fillable = [''];
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return $this->username;
    }
}
