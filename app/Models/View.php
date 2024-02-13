<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $fillable = ['recipe_id', 'views_count'];
    
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
