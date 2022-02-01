<?php

namespace App\Console\Commands;

use App\Mail\DailyQuotesTotal;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailQuotesTotals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:quotes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a report of the total of all quotes for the day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $quotes = Quote::where('created_at', '>=', Carbon::today())->get();
        $total = $quotes->sum('total');
        Mail::to('admin@admin.com')->send(new DailyQuotesTotal($quotes, $total));
        $this->info('Daily report sent to admin@admin.com');
        return 0;
    }
}
