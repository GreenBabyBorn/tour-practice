<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TourPhoto;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'from',
        'to',
        'date',
        'cost',
    ];
    public function photos()
    {
        return $this->hasMany(TourPhoto::class);
    }
}
