<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\agenda;
use Illuminate\Console\Command;

class NotifikasiAgenda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notifikasiAgenda';

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
        $notif = agenda::where('notification', true)->where('tanggal', Carbon::now()->isoFormat('YYYY-MM-DD'))->Notification()->get();
        foreach ($notif as $key) {
            if ($key->meetingId) {
                $meetingId=$key->meetingId;
            }else{
                $meetingId="-";
            }
            if ($key->meetingPassword) {
                $meetingPassword=$key->meetingPassword;
            }else{
                $meetingPassword="-";
            }

            if ($key->linkRapat) {
                $linkRapat=$key->linkRapat;
            }else{
                $linkRapat="-";
            }

            if ($key->linkAbsensi) {
                $linkAbsensi=$key->linkAbsensi;
            }else{
                $linkAbsensi="-";
            }

            // $body = "Reminder \nAgenda  : $key->agenda \nWaktu   : $key->waktu \nTempat : $key->tempat".$meetingId.$meetingPassword.$linkRapat.$linkAbsensi;
            // $body = '"components"=>[array("type"=>"body","parameters"=>[array("type"=>"text", "text"=>"'.$key->agenda.'"),array("type"=>"text", "text"=>"'.$key->waktu.'"),array("type"=>"text", "text"=>"'.$key->tempat.'"),array("type"=>"text", "text"=>"'.$meetingId.'"),array("type"=>"text", "text"=>"'.$meetingPassword.'"),array("type"=>"text", "text"=>"'.$linkRapat.'"),array("type"=>"text", "text"=>"'.$linkAbsensi.'")])]';
            notifikasiAgenda($key->agenda,$key->waktu,$key->tempat,$meetingId,$meetingPassword,$linkRapat,$linkAbsensi);

            
            agenda::find($key->id)->update(['notification'=>false]);
        }
        
    }
}
