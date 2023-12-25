<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ForgotPasswordEmail extends Notification
{
    use Queueable;

    private $user;

    private $token;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param string $token
     */
    public function __construct(User $user, string $token)
    {
        $this->token = $token;
        $this->user  = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(mail_content('forgot_password.subject'))
            ->greeting(mail_content('forgot_password.greeting') . $this->user->fullname . '!')
            ->line(mail_content('forgot_password.line'))
            ->action(mail_content('forgot_password.action'), route('auth.showChangePasswordForm', ['token' => $this->token]))
            ->line(mail_content('forgot_password.thank'))
            ->salutation(new HtmlString(mail_content('verify.regards') . "<br /> " . config('APP_NAME')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
