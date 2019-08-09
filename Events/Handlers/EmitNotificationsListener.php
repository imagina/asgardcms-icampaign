<?php

namespace Modules\Icampaign\Events\Handlers;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Modules\Inotification\Events\SendWhatsAppNotification;
use Modules\Inotification\Events\NotificationEvent;

class EmitNotificationsListener
{

  /*
 * To add other notification shipments, you must generate a private class
 * methodology where you can make the necessary logic or data format that
 * the notification needs to be sent, once the function with this independent
 * logic has been generated, you must perform denting of the method of managing
 * the this class
 *                                                           By Imagina Colombia
 */

  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
      //
  }

  /**
   * Handle the event.
   *
   * @param  object  $event
   * @return void
   */
  public function handle($event)
  {
      $this->SenWhatsappWithTwilio($event);
      $this->SendAppNotificationWithPusher($event);
  }

  /**
   * Format the data to be sent to whatsapp through twilio
   * @params $event
   */
  private function SenWhatsappWithTwilio ($event) {

    $sid = $event->recipient->campaign['account_sid'];
    $token = $event->recipient->campaign['auth_token'];
    $sender = $event->recipient->campaign['sender'];
    $template = $event->recipient->campaign['init_message'];
    $user = $event->recipient->name;
    $phone = $event->recipient->phone;
    event(new SendWhatsAppNotification($sid, $token, $sender, $template, $user, $phone));
  }

  private function SendAppNotificationWithPusher ($event) {
    $userId = $event->recipient->campaign['user_id'];
    $data = $event->recipient;
    event( new NotificationEvent($userId, $data) );
  }

  // ...



}
