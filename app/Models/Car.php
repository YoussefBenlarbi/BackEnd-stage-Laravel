<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'name',
        'dailyPrice',
        'monthlyPrice',
        'mileage',
        'gearType',
        'gasType',
        'description',
        'status',
        'thumbnailUrl'
    ];
    public function reservations()
    {

        return $this->hasMany(Reservation::class);
    }
}
