<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\agenda;
use Illuminate\Console\Command;

class NotifikasiAbsenPagi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notifikasiAbsenPagi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        notifikasiAbsen('pagi', 'masuk', config('whatsapp.key'), config('whatsapp.phoneNumber'));
    }
}
