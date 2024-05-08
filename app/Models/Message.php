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

    public function timeElapsed(): array {
        $secondElapsed = time() - $this->created_at->getTimeStamp() ;
        $months = $secondElapsed / (60*60*24*7*4);
        $secondElapsed %= 60*60*24*7*4;
        
        $weeks = $secondElapsed / (60*60*24*7);
        $secondElapsed %= 60*60*24*7;

        $days = $secondElapsed / (60*60*24);
        $secondElapsed %= 60*60*24;
        
        $hours = $secondElapsed / (60*60);
        $secondElapsed %= 60*60;

        $minutes = $secondElapsed / 60;
        $secondElapsed %= 60;
        
        return array([
            'months' => floor($months) > 0 ? floor($months) . ' mois' : null,
            'weeks' => floor($weeks) > 0 ? floor($weeks) . ' semaine(s)' : null,
            'days' => floor($days) > 0 ? floor($days) . ' jour(s)' : null,
            'hours' => floor($hours) > 0 ? floor($hours) . ' heure(s)' : null,
            'minutes' => floor($minutes) > 0 ? floor($minutes) . ' minute(s)' : null,
            'seconds' => floor($secondElapsed) > 0 ? floor($secondElapsed) . ' seconde(s)' : null,
        ]);
    }

    public function getTimeElapsed() {
        
        $result = null ;
        foreach(($this->timeElapsed())[0] as $key => $value) {
            if($value !== null){
                $result = $value;
                break;
            }
        }
        return $result == null ? '1 seconde' : $result; 
    }
}
