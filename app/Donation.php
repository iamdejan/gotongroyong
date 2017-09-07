<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model {
    protected $primaryKey = "id";

    public function user() {
        return $this->belongsTo("App\User", "usermail", "email");
    }
}
