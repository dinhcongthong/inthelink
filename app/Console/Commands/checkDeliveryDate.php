<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class checkDeliveryDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:check_delivery_date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will check if order status is on going after 7 days automatic update to delivered';

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
     * @return mixed
     */
    public function handle()
    {
        // status = 1 is delivering 2 is delivered. defined in helpers.php
        Order::whereStatus(Order::ON_GOING_STATUS)
            ->where('created_at', '<', Carbon::now()->subDay(7))
            ->update(['status' => Order::DELIVERED_STATUS]);

    }
}
