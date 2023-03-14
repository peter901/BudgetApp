<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $fillable = ['description','categroy_id','amount','date'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
