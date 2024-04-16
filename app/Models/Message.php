<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Request;

class Message extends Model
{
    protected $fillable = [
        'content',
        'read_at',
        'send_at',
        'author_id',
        'receiver_id'
    ];

    use HasFactory;

    public function users(): BelongsTo {

        return $this->belongsTo(User::class);
    }
}
