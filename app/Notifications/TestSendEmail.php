<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\TestSendEmail;
use App\Models\User;

class TestSendEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $data;

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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
  {
 return (new MailMessage)
 ->subject("Đặt hàng thành công")
 ->view("email_template.don_hang_thanh_cong",["data"=>$this->data]);
  }

public function testemail() 
{
    $user = User::find(1); 
    
    $user->notify(new TestSendEmail()); 
    
    return "Đã gửi email thử nghiệm thành công! Kiểm tra hộp thư của bạn nhé.";
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
