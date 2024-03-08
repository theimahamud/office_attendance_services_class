<?php

namespace App\Notifications;

use App\Models\LeaveRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestApprovedRejectedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $data;

    public function __construct(LeaveRequest $leaveRequest)
    {
        $this->data = $leaveRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->view('emails.leave-request-approved-rejected', ['data' => $this->data])->subject("Leave Request {$this->data->status}");
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
            'leave_request_id' => $this->data->id,
            'link' => route('leave-request.show', $this->data->id),
            'message' => 'leave_request_approved_rejected',
            'status' => $this->data->status,
        ];
    }
}
