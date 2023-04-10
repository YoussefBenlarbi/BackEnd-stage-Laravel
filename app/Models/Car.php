<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];
    // $table->id();
    //         $table->string('name');
    //         // $table->string('plat');
    //         $table->float('pricePerDay');
    //         $table->float('pricePerMonth');
    //         $table->float('mileage');
    //         $table->string('gearType');
    //         $table->string('gasType');
    //         $table->text('description')->nullable();
    //         $table->boolean('status')->default(0);
    //         $table->string('thumbnailUrl');
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
