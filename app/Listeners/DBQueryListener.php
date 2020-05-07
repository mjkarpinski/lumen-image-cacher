<?php

namespace App\Listeners;

use App\Events\FreshNasaCallEvent;
use Illuminate\Support\Facades\DB;

class DBQueryListener
{
    public function handle(FreshNasaCallEvent $event)
    {
        if (empty(DB::select("SELECT data FROM mars.imagedata where hash = ?", [$event->hash]))) {
            DB::insert('insert into mars.imagedata (hash, data) values (?, ?)', [$event->hash, $event->data]);
        };
    }
}
