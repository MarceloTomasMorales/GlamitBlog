<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table="posts";

    protected $primaryKey="id";

    public $timestamps=true;

    protected $fillable=[
        "title",
        "body",
        "image"
    ];

    protected $guarded =[
    	
    ];
}
