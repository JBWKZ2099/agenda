<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

class FrontEndController extends Controller
{
    public function redirect() {
        return Redirect::to("admin");
    }
}
