<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\agenda;
use Illuminate\Console\Command;

class NotifikasiAbsenSore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notifikasiAbsenSore';

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

        notifikasiAbsen('Sore', 'pulang', config('whatsapp.key'), config('whatsapp.phoneNumber'));
    }
}
