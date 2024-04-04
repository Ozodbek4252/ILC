<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramController extends Controller
{
    public static function sendMessageToGroup(Request $request)
    {
        $botToken = env('TG_BOT_TOKEN');
        $chatId = env('TG_CHAT_ID');

        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $message = $request->input('message');
        $ip = $request->ip();
        $time = now()->format('d.m.Y - H:i');

        $send_message = "👨‍💻 Имя: {$name}\n📞 Телефон: {$phone}\n📧 Email: {$email}\n📝 Сообщение: {$message}\nIP: {$ip}\n⏰ Время заказа: {$time}";

        if (!$email) {
            $send_message = "👨‍💻 Имя: {$name}\n📞 Телефон: {$phone}\n📝 Сообщение: {$message}\nIP: {$ip}\n⏰ Время заказа: {$time}";
        }

        if (!$message) {
            $send_message = "👨‍💻 Имя: {$name}\n📞 Телефон: {$phone}\n📧 Email: {$email}\nIP: {$ip}\n⏰ Время заказа: {$time}";
        }

        if (!$email && !$message) {
            $send_message = "👨‍💻 Имя: {$name}\n📞 Телефон: {$phone}\nIP: {$ip}\n⏰ Время заказа: {$time}";
        }

        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
        Http::post($url, [
            'chat_id' => $chatId,
            'text' => $send_message,
        ]);
    }
}
