<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $guarded = [''];

    protected $table = "results";
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function question()
    {
        return $this->belongsTo(Question::class,  'users_id');
    }

   
}
