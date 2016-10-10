<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegister extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
    protected $link;

    public function __construct(User $user, $link)
    {
        //
        $this->user = $user;
        $this->link = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)//hàm này để xác định gửi mail hay là gửi vào database
    {
        return ['mail'];//gửi mail
//        return ['mail','database'];//gửi mail và chuyển vào database
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)//hàm chuyền biến vào mail
    {
        return (new MailMessage)
            ->subject('Thông báo kích hoạt tài khoản')
            ->line('Chào mừng bạn đến với Laravel sida shop.')
            ->action('Ấn vào đây để kích hoạt bạn nhé', url($this->link))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
