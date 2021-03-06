<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyQuotesTotal extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $quotes;
    public $total;

    public function __construct($quotes, $total)
    {

        $this->quotes = $quotes;
        $this->total = $total;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Quotes Summary: '.Carbon::today()->format('d/m/Y'))
            ->markdown('emails.dailyquotestotal');
    }
}
