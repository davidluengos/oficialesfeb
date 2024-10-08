<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOfficial extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
        'surname',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
