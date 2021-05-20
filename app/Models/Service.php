<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = "service";
    protected $fillable = [
        "title", "description", "photo", "user_id"
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
