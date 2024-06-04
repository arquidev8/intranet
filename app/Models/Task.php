<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'completed',
        'created_by',
        'visible_para' // Agrega este campo para indicar el ID del empleador
    ];


        public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
   // Corrección de la relación visibleTo
   public function visibleTo()
   {
       return $this->belongsTo(User::class, 'visible_para');
   }
   
   public function comments()
   {
       return $this->hasMany(Comment::class);
   }


}
