<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use  App\Http\Controllers\Backend\Traits\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;
}
