<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*public function getTelAttribute()
    {
        return ($this->tel1) . '-' .($this->tel2). '-' .($this->tel3);
    }*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeContactSearch($query, $gender, $category_id, $created_at)
    {
        if (!empty($gender) && !empty($category_id) && !empty($created_at)) {
            $query->where('gender', $gender)
                ->where('category_id', $category_id)
                ->where('created_at', $created_at);
        }
        return $query;
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
        $query->where('last_name', 'like', '%' . $keyword . '%')
        ->orWhere('first_name', 'like', '%' . $keyword . '%')
        ->orWhere('email', 'like', '%' . $keyword . '%');
        }
    }
}
