<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{

    public function index() {

        $lol = asset('storage/profile-photos/XbYWfvc5w4LiB2xvNXrZNXmfSnR9xhup4zRsU1rF.png');
        return Inertia::render('Gallery/Show', [
            'photos' => [$lol,$lol, $lol, $lol, $lol, $lol, $lol, $lol ,$lol, $lol, $lol, $lol, $lol, $lol]
        ]);
    }
    public function add(Request $request) {

        Log::info($request);
    }


}
