<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function passport()
    {
        return $this->belongsTo(Passport::class);
    }

    protected $guarded = [];
}
