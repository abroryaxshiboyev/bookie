<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'discount_id',
    ];

    public function book(){
        return $this->belongsTo(Book::class)->withTrashed();
    }
    public function discount(){
        return $this->belongsTo(Discount::class);
    }
}
