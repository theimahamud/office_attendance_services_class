<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HolidayNoticeNotificationCreate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $data;

    public function __construct($holidayNotice)
    {
        $this->data = $holidayNotice;
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
        return (new MailMessage)->view('emails.notice',['data'=>$this->data])->subject($this->data->title);
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'holiday_notice_id' => $this->data->id,
            'message' => 'notice_for_all',
            'title' => $this->data->title,
            'link' => route('holiday.show',$this->data->id),
        ];
    }
}
