<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferMade extends Notification
{
    use Queueable;

    public function __construct(private Offer $offer)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
            ->view(
                [
                    'text' => 'emails.offer-made'
                ],
                [
                    'offer' => $this->offer,
                    'user' => $notifiable,
                ]
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'offer_id' => $this->offer->id,
            'apartment_id' => $this->offer->apartment_id,
            'amount' => $this->offer->amount,
            'offer_by_user_id' => $this->offer->offer_by_user_id,
        ];
    }
}
