<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RemarkRecord extends Model
{
    use HasFactory;
    protected $table = 'remark_record';
    protected $fillable =[ 'description' ];


    // Define the inverse of the one-to-many relationship
   // public function note()
    //{
       // return $this->belongsTo(NoteRecord::class, 'note_id');  // 'note_id' is the foreign key
   // }
}
