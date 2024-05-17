<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
    ] ;

    public function getCreationDate(): string{
        return (new Carbon($this->created_at))->format('Y-m-d');
    }
}
