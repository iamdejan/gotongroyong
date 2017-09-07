<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller {

    public function start() {
        return view("welcome.start");
    }

    public function profil() {
        return view("welcome.profile");
    }

    public function kontak() {
        return view("welcome.contact");
    }
}
