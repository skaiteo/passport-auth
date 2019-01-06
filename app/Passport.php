<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    // protected $fillable = [
    //     'firstname', 'lastname', 'passport_num', 'country', 'dob', 'gender', 'expiry_date', 'age'
    // ];

    protected $hidden = ['user_id'];

    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
