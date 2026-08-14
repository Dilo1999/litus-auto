<?php

namespace App\Http\Controllers;

use App\Models\Showroom;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $showrooms = Showroom::query()
            ->published()
            ->ordered()
            ->get()
            ->map(fn (Showroom $showroom) => $showroom->toViewArray())
            ->all();

        return view('about', compact('showrooms'));
    }
}
