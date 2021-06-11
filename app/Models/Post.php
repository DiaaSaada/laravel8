<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'title' ,
        'body' ,
        'user_id' ,
    ] ;

    /**
     * @var string
     */
    private string $title;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
