<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
