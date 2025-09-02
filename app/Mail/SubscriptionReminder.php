<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $remaining_day;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $remaining_day)
    {
        //
        $this->user = $user;
        $this->remaining_day = $remaining_day;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            //code...
            if ($remaining_day == 7) {
                # code...
                return $this->subject('Your free trial is about to expire!')
                ->view('emails.7days_reminder')
                ->with([
                    'customer_name' => $this->user->first_name,
            
                ]);
            }
    
    
            if ($remaining_day == 15) {
                # code...
                return $this->subject('Your free trial is about to expire!')
                ->view('emails.7days_reminder')
                ->with([
                    'customer_name' => $this->user->first_name,
            
                ]);
            }
    
            if ($remaining_day == 1) {
                # code...
                return $this->subject('Your free trial is expiring today!')
                ->view('emails.1day_reminder')
                ->with([
                    'customer_name' => $this->user->first_name,
            
                ]);
            }

        } catch (\Throwable $th) {
            //throw $th;
        }        
    }
}
