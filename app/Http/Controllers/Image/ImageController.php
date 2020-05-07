<?php

namespace App\Http\Controllers\Image;

use App\Events\FreshNasaCallEvent;
use App\Http\Controllers\Controller;
use App\Library\ImageCacher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MarsRovers\MarsRover;
use Illuminate\Support\Facades\Event;

class ImageController extends Controller
{
    public function index(Request $request, string $rover, string $camera, int $sol)
    {
       $data = (new MarsRover(env('NASA_API_KEY', '')))->getPictures($rover, $camera, $sol);

       $imageCacher = new ImageCacher($data);
       $imageCacher->save();

       $data = $imageCacher->getData();

       Event::dispatch(new FreshNasaCallEvent(md5($request->path()), $data));

       return new Response($data);
    }
}
