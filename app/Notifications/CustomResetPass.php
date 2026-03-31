<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
class CustomResetPass extends Notification
{
    use Queueable;
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

   public function toMail($notifiable)
{
    // Lấy link reset mật khẩu
    $url = route("password.reset", ["token" => $this->token, "email" => $notifiable->getEmailForPasswordReset()]);

    return (new MailMessage) // Viết ngắn gọn thế này thôi
            ->subject('Lấy lại mật khẩu')
            ->view('email_template.reset_pass', compact("url"));
}
}