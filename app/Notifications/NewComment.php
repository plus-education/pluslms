<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\Notifications\NovaChannel;

class NewComment extends Notification
{
    use Queueable;

    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'database',
            'broadcast',
            NovaChannel::class,
        ];
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'info' => $this->details['title'],
            'subtitle' => $this->details['details'],
            'type' => 'info'
        ];
    }

    /**
     * Get the nova representation of the notification
     * 
     * @return array
     */
    public function toNova($notifiable)
    {
        return (new NovaNotification)
            ->message($this->details['title'] . ' - ' . $this->details['details'])
            //->action('Download', URL::remote('https://example.com/report.pdf'))
            ->icon('download')
            ->type('info');
    }
}
