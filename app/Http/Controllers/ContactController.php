<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\AppliesPageSeo;
use App\Models\Showroom;
use Illuminate\View\View;

class ContactController extends Controller
{
    use AppliesPageSeo;

    public function index(): View
    {
        $this->applySeo('contact');

        $visitShowrooms = Showroom::query()
            ->published()
            ->ordered()
            ->get()
            ->map(fn (Showroom $showroom) => $showroom->toViewArray())
            ->all();

        return view('contact', compact('visitShowrooms'));
    }
}
