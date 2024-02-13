<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','category_id','title', 'ingredients','servings', 'steps','total_time', 'image','video'];

    public  function user() {
            return $this->belongsTo(User::class);
    }
    public function views()
    {
        return $this->hasMany(View::class);
    }
}
