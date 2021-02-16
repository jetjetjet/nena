<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    // protected $table = 'tweet';
    // protected $primaryKey = 'tweetid';
    // public $incrementing = false;
    // public $timestamps = false;
    protected $fillable = [
      'tweetcode',
      'username',
      'tweetava',
      'tweetraw',
      'tweettext',
      'tweetdate',
      'tweetdecision',
      'tweetscorepos',
      'tweetscorenet',
      'tweetscoreneg'
    ];

    // public function analytic()
    // {
    //   return $this->belongsTo(Analytic::class, 'foreign_key', 'tweetid');
    // }
}