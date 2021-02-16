<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    use HasFactory;

    protected $fillable = [
        'tweetid',
        'analytictext',
        'scorepositif',
        'scorenetral',
        'scorenegatif'
      ];

    public function tweet()
    {
        return $this->hasOne(Tweet::class);
    }
}