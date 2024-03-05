<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestSendNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->view('emails.leave-request-send',['data'=>$this->data])->subject('Application For Leave');
//                    ->greeting("Hello, {$notifiable->name}")
//                    ->subject('Application For Leave')
//                    ->line("You have received a leave request from {$this->data->name}.")
//                    ->action('View request', route('leave-request.show',$this->data->id));

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'leave_request_id'=>$this->data->id,
            'message'=>'leave_request_send',
            'name'=>$this->data->name,
            'link'=>route('leave-request.show',$this->data->id),
        ];
    }
}
