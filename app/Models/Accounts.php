<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $table = "accounts";
    protected $fillable = ["first_name", "last_name", "description", "logo", "user_id"];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function background()
    {
        return $this->hasMany(Background::class);
    }
}
