<?php

namespace App\Console\Commands;

use App\Models\reminder;
use Illuminate\Console\Command;

class NotifikasiPersonal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notifikasiPersonal';

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
        $notif = reminder::Notification();
        
        foreach ($notif as $key) {
            notifikasiPersonal($key->id,$key->pengirim->nama,$key->pesan,config('whatsapp.key'),config('whatsapp.phoneNumber'));
            reminder::where('id', $key->id)->update(['notifikasi'=>false]);
        }
        
    }
}
