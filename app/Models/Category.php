<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name' , 'parent_id' , 'slug' , 'status' , 'description', 'image', 'admin_data',
    ];
    protected $casts = [
        'admin_data' => 'array' ,
    ];
    public function getImageUrlAttribute()
    {
        if($this->image == " "){
            return asset('image/placeholder.png');
        }
        else if(stripos($this->image , 'http') === 0)
        {
            return $this->image;
        }else{
            return asset('storage/' . $this->image);
        }
    }

    public function products()
    {
        return $this->hasMany(Product::class , 'category_id' , 'id');
    }

    public function children()
    {
        return $this->hasMany(Category::class , 'parent_id' , 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class , 'parent_id' , 'id')->withDefault([
            'name' => 'No Parent',
        ]);
    }
}
