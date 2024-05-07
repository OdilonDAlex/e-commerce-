<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Cart\Item;
use App\Models\Product;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProductAddedToCart extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Item $item
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(User $user): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }
    
    public function broadcastType(): string
    {
        return 'product-added-to-cart';
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    public function toArray(User $user): array {
        $product = Product::find((int) $this->item->product_id);
        return [
            'user_id' => $user->id,
            'title' => 'Ajout de produit',
            'content' => 'Vous-avez ajouté ' . $this->item->quantity . ' ' . htmlspecialchars_decode($product->name) . ' dans votre panier',
        ];
    }
}
