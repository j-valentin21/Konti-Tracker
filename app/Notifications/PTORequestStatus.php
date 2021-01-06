<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PTORequestStatus extends Notification
{
    use Queueable;

    /**
     * Get requested PTO dates.
     *
     * @var $dates
     */
    public $dates;

    /**
     * Create a new notification instance.
     *
     * @param $dates
     */
    public function __construct($dates)
    {
        $this->dates = $dates;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

//    /**
//     * Get the database representation of the notification.
//     *
//     * @return array
//     */
//    public function toDatabase()
//    {
//        return [
//            'name' => 'Admin',
//            'message' => 'Your PTO request has been approved for the following days:' . $this->dates
//        ];
//    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'name' => 'Admin',
            'message' => ' approved your request for the following days:' . $this->dates
        ];
    }
}
