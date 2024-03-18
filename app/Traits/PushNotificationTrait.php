<?php

namespace App\Traits;

use App\Models\Notification;
use Kutia\Larafirebase\Facades\Larafirebase;

trait PushNotificationTrait
{
    public function pushNotification(array $tokens, array $message)
    {
        Notification::create($message);
        $response = Larafirebase::
        withTitle($message['subject'])
            ->withBody($message['message'])
            ->withIcon(asset('logo.png'))
            ->withSound('default')
            ->withAdditionalData([
                'color' => '#06327a',
                'badge' => 0,
            ])
            ->sendNotification($tokens);
         if ($response['success'] == 1) {
             return true;
         } else {
             return false;
         }
    }


}
