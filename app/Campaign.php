<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model {

    public static function original_fund() {
        return (100 / 105) * floatval($this->actual_fund);
    }

    public function user() {
        return $this->belongsTo("App\User", "usermail", "email");
    }

    public function comments() {
        return $this->hasMany("App\Comment", "campid", "id");
    }
}
