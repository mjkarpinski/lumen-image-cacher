<?php

namespace App\Events;

class FreshNasaCallEvent extends Event
{
    public $hash;
    public $data;

    public function __construct(string $hash ,string $data)
    {
        $this->hash = $hash;
        $this->data = $data;
    }
}
