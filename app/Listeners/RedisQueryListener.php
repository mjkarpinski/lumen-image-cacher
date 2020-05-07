<?php

namespace App\Listeners;

use App\Events\FreshNasaCallEvent;
use Illuminate\Support\Facades\Redis;

class RedisQueryListener
{
    public function handle(FreshNasaCallEvent $event)
    {
        Redis::set($event->hash, $event->data);
    }
}
