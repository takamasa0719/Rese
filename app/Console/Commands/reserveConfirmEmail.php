<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Models\Reservation;

class reserveConfirmEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '予約確認メールの送信';

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
        $reserves = Reservation::with(['user', 'shop'])
        ->where('date', date('Y-m-d'))->get();

        if(isset($reserves)){
            foreach($reserves as $reserve){
                Mail::send('emails.reserveConfirm',
                ['reserve' => $reserve], function($message) use ($reserve){
                    $message->to($reserve->user->email)
                    ->subject('本日来店予定のご予約があります');
                });
            };
        };
    }
}
