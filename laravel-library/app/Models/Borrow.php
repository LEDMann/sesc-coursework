<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Borrow extends Pivot
{
    use HasFactory;

    /**
     * Get the book for the booking.
     */
    public function book(): Hasone
    {
        return $this->hasOne(Book::class);
    }

    /**
     * Get the user for the enrolment.
     */
    public function user(): hasOne
    {
        return $this->hasOne(User::class);
    }
}
