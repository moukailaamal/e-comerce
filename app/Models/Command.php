<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;
    protected $fillable = [
    
        'statut',
        'user_id',
        'contenu',
        'adresse',

     
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
