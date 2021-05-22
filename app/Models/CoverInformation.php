<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverInformation extends Model
{
    use HasFactory;

    protected $table = "cover_information";
    protected $fillable = ["title", "child_title", "description", "accounts_id"];

    public function accounts()
    {
        return $this->hasOne(Accounts::class);
    }
}
