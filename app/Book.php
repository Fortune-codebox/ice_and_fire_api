<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";
    protected $guarded = [];

    public static function createIfNotExist($req){

        $result = self::where($req)->first();
        if(!empty($result)){
            return false;
        }
        return self::create($req);
    }
}
