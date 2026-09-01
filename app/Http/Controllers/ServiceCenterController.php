<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\AppliesPageSeo;
use Illuminate\View\View;

class ServiceCenterController extends Controller
{
    use AppliesPageSeo;

    public function __invoke(): View
    {
        $this->applySeo('service-center');

        return view('service-center');
    }
}
