<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    public $token;

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
        return (new MailMessage)
            ->subject('Recuperar Contraseña')
            ->line('Solicitaste recuperar tu contraseña de expositor del Festival de Invierno 2020.')
            ->action('Recupera tu contraseña', url('password/reset', $this->token))
            ->line('Si tu no solicitaste la recuperación de contraseña, no realices ninguna acción.');
    }
}