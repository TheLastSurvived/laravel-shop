<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category', 
        'price',
        'description',
        'image'
    ];


    // Константы категорий
    const CATEGORIES = [
        'road' => 'Дорожные',
        'mountain' => 'Горные',
        'hybrid' => 'Гибридные',
        'electric' => 'Электрические',
        'bmx' => 'BMX',
        'kids' => 'Детские'
    ];

    // Геттер для читаемого названия категории
    public function getCategoryNameAttribute()
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }

    public function getImageUrlAttribute()
{
    return $this->image ? asset('storage/' . $this->image) : asset('images/no-image.png');
}
}
