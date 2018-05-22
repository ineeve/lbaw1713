<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

//Trait
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller {
  
  //Sends Password Reset emails
  use SendsPasswordResetEmails;
}