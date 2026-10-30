<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HelpDocController extends Controller
{
    public function cloudHosting(): View
    {
        return view('help.cloud-hosting', [
            'activeDoc' => 'cloud',
        ]);
    }

    public function supportMaintenance(): View
    {
        return view('help.support-maintenance', [
            'activeDoc' => 'support',
        ]);
    }

    public function customServices(): View
    {
        return view('help.custom-services', [
            'activeDoc' => 'services',
        ]);
    }

    public function modules(): View
    {
        return view('help.modules', [
            'activeDoc' => 'modules',
        ]);
    }

    public function devDocs(): View
    {
        return view('help.dev-docs', [
            'activeDoc' => 'dev',
        ]);
    }

    public function userGuide(): View
    {
        return view('help.user-guide', [
            'activeDoc' => 'guide',
        ]);
    }
}
