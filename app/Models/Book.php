<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory,SoftDeletes;
    use Searchable;

    protected $fillable = [
        'name',
        'author_name',
        'title',
        'price',
        'rating',
        'click'
    ];


    public function toSearchableArray()
    {
        return [
            'name'=>$this->name,
            'author_name'=>$this->author_name
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_books')->as('categories')->withTrashed();
    }

    public function users(){
        return $this->belongsToMany(User::class,'orders')->as('orders')->withTrashed();
    }

    public function photo(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function audios()
    {
        return $this->hasMany(Audio::class);
    }

    public function basket(){
        if(auth()->user())
            return $this->hasMany(Basket::class)->where('user_id',auth()->user()->id);
        else
            return $this->hasMany(Basket::class)->where('user_id',0);
    }
    public function favorite(){
        if(auth()->user())
            return $this->hasMany(Favorite::class)->where('user_id',auth()->user()->id);
        else
            return $this->hasMany(Favorite::class)->where('user_id',0);
    }
    public function comments(){
        return $this->hasMany(Review::class);
    }
}
