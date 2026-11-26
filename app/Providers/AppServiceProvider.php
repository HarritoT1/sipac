<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifica tu correo electrónico ' . config('app.name'))
                ->greeting("¡Hola estimado usuario {$notifiable->name}! Te saluda " . config('app.name') . '.')
                ->line('Gracias por registrarte en nuestra plataforma.')
                ->line('Por favor verifica tu correo electrónico haciendo clic en el botón de abajo.')
                ->action('Verificar correo electrónico', $url)
                ->line('Si no creaste una cuenta, puedes ignorar este mensaje.')
                ->salutation('Saludos, ' . config('app.name'));
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = config('app.url') . "/reset-password/" . $token . "?email=" . urlencode($notifiable->email);

            return (new MailMessage)
                ->subject('Restablecimiento de contraseña ' . config('app.name'))
                ->greeting("¡Hola estimado usuario {$notifiable->name}! Te saluda " . config('app.name') . '.')
                ->line('Para restablecer tu contraseña, haz clic en el botón de abajo.')
                ->action('Restablecer contraseña', $url)
                ->line('Este enlace de restablecimiento de contraseña caducará a las: ' . now()->addMinutes(config('auth.passwords.users.expire'))->format('H:i'))
                ->line('Si no solicitaste restablecer tu contraseña, puedes ignorar este mensaje.')
                ->salutation('Saludos, ' . config('app.name'));
        });
    }
}
