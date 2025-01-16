<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'url', 'image'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function profileImage() {
        // $imagePath = $this->image ? $this->image : 'profile/istockphoto-1159947597-612x612.jpg';
        // return '/storage/' . $imagePath;

        return '/storage/' . ($this->image ? $this->image : 'profile/istockphoto-1159947597-612x612.jpg');
    }

    public function followers() {
        return $this->belongsToMany(User::class);
    }
}
