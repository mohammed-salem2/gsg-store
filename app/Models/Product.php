<?php

namespace App\Models;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use NumberFormatter;

class Product extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'name' , 'category_id' , 'slug' , 'status' , 'description','price','sale_price','quantity',
        'sku' , 'weight' , 'width', 'height' , 'length', 'image', 'admin_data', 'user_id',
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

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function getFormattedPriceAttribute()
    {
        $formatter = new NumberFormatter(App::getLocale() , NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price , 'USD');
    }

    public function category()
    {
        return $this->belongsTo(Category::class , 'category_id' , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
    public function ratings()
    {
        return $this->morphMany(Rate::class , 'rateable' , 'rateable_type' , 'rateable_id' ,'id');
    }
}
