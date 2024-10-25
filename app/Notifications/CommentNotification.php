<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Comment;

class CommentNotification extends Notification
{
    use Queueable;

    public $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment->load('user');
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; // Include mail and database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('A new comment has been posted.')
                    ->action('View Comment', url('/comments/'.$this->comment->id))
                    ->line('Thank you for staying engaged!');
    }

    /**
     * Get the array representation of the notification (for database storage).
     */
    public function toArray(object $notifiable): array
    {
        return [
        'comment_id' => $this->comment->id,
        'comment_text' => $this->comment->comment,
        'user_id' => $this->comment->user_id,
        'user_first_name' => $this->comment->user ? $this->comment->user->firstName : 'Unknown First Name',
        'user_last_name' => $this->comment->user ? $this->comment->user->lastName : 'Unknown Last Name',
        'message' => 'A new comment has been posted by ' . ($this->comment->user->firstName ?? 'Unknown') . ' ' . ($this->comment->user->lastName ?? '') . ': "' . $this->comment->comment . '"',
        ];
    }
}