<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserModel extends Authenticable implements JWTSubject
{
    // use HasFactory;

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    // protected $fillable = ['user_id', 'level_id', 'username', 'nama', 'password'];
    // protected $fillable = ['level_id', 'username', 'nama'];
    protected $fillable = [
        'username', 
        'nama', 
        'password', 
        'level_id', 
        'image',
    ];

    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => url('/storage/posts/' . $image),
        );
    }
}