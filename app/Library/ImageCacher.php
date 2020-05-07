<?php

namespace App\Library;

use Intervention\Image\ImageManager;

class ImageCacher
{
    private $data;

    public function __construct(string $data)
    {
        $this->data = json_decode($data);
    }

    public function saveImage($imageUrl): bool
    {
        return app('filesystem')->put('images/'.md5($imageUrl). '.jpg', $this->resizeImage($imageUrl));
    }

    private function resizeImage(string $url): string
    {
        $manager = new ImageManager(array('driver' => 'gd'));

        return $manager->make($url)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->stream('jpg', 60);
    }

    public function save(): void
    {
        foreach ($this->data as &$image) {
            $this->saveImage($image->url);
            $image->thumbnail = md5($image->url) . '.jpg';
        }
    }

    public function getData(): string
    {
        return json_encode($this->data);
    }

}
