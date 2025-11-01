<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuestBook extends Model
{
    use HasFactory;
    protected $table = 'tamu';

    protected $guarded = [
        'id',
    ];

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }

    public function purpose(): BelongsTo
    {
        return $this->belongsTo(Purpose::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
