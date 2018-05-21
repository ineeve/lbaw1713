<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller {
  
  //trait for handling reset Password
  use ResetsPasswords;
}