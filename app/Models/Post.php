<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['category','city'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['city'] ?? false, function ($query, $city) {
            return $query->whereHas('city', function ($query) use ($city) {
                $query->where('slug', $city);
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Mengubah route pencarian saat menggunakan resource (defaultnya id)
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function sub_categories(){
        return $this->belongsToMany(Sub_category::class);
    }
}
