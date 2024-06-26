<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSpecialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'specialization_id');
    }

}
