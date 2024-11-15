<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteRecord extends Model
{
    use HasFactory;
    protected $table = 'note_record';
    protected $fillable =[ 'name', 'description', 'user_id'  ];

    /**
     * Define the relationship with User.
     * A NoteRecord belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     // Define the one-to-many relationship
     //public function remark()
    // {
     //    return $this->hasMany(RemarkRecord::class, 'note_id');  // 'note_id' is the foreign key
     //}
}

