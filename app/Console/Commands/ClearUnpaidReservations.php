<?php

namespace App\Console\Commands;

use App\Helpers\ReservationHelper;
use Illuminate\Console\Command;

class ClearUnpaidReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-unpaid-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ReservationHelper::delete_unpaid_reservations();
    }
}
