<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['Title','Body','Temp'];
    public static function display($temp){

        $val = static::all($temp);
        return $val;
    }
    
}
