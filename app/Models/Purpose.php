<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function tamu()
    {
        return $this->hasMany(GuestBook::class, 'purpose_id');
    }
}
