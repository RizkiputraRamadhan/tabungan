<?php

namespace App\Models;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $table = "questions";
    protected $guarded = [];
    public function Categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

}
