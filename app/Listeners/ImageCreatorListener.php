<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use App\Events\FreshNasaCallEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ImageCreatorListener
{
    public function handle(FreshNasaCallEvent $event)
    {
        //
    }
}
