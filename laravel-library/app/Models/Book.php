<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'fee',
    ];
    
    /**
    * The users that belong to the course.
    */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book')->using(Book::class);
    }

    /**
    * The books that belong to the course.
    */
    public function books(): hasMany
    {
        return $this->hasMany(Book::class);
    }
}
