<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Basket extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'book_id',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class)->withTrashed();
    }
}
