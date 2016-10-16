<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordedGamePlayer extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function analysis()
    {
        return $this->belongsTo(RecordedGameAnalysis::class);
    }
}