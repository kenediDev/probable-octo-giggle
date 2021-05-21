<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    use HasFactory;

    protected $table = "background";
    protected $fillable = ["background", "accounts_id"];

    public function accounts()
    {
        return $this->belongsTo(Accounts::class);
    }
}
