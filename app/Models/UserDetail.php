<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'cin'
        , 'address'
        , 'sexe'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
