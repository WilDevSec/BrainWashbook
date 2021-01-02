<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentOnPost extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        this->post = $post;
        this->user = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $id = $post->id;
        $url = url('project1.test/posts/'$id);
        return (new MailMessage)
                    ->from('BWB@example.com', 'BrainWashBook')
                    ->greeting('Hello human being!')
                    ->line('Someone has commented in one of your posts!')
                    ->line('View the post here:')
                    ->action('View Post', $url)
                    ->line('Thank you for using BrainWashBook!');
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
            'post' => this.$post,
            'user' => this.$user,
        ];
    }
}
