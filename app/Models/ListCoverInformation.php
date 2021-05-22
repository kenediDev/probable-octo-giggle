<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListCoverInformation extends Model
{
    use HasFactory;

    protected $table = "list_information";
    protected $fillable = ["description", "cover_information_id"];

    public function cover_information()
    {
        return $this->hasOne(CoverInformation::class);
    }
}
