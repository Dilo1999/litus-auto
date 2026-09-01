<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\AppliesPageSeo;
use App\Models\Showroom;
use Illuminate\View\View;

class ServiceCenterController extends Controller
{
    use AppliesPageSeo;

    public function __invoke(): View
    {
        $this->applySeo('service-center');

        $pickDropAreas = Showroom::pickDropAreaOptions();

        return view('service-center', compact('pickDropAreas'));
    }
}
