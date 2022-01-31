<?php

namespace App\Http\Controllers;

use App\Mail\SendQuoteMail;
use App\Models\Quote;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function send(Quote $quote)
    {
        \Mail::to($quote->customer_email)->send(new SendQuoteMail($quote));
    }
}
