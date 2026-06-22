<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Subscriber;
use App\Services\SiteData;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(SiteData $siteData)
    {
        return view('site', [
            'data' => $siteData->build(),
        ]);
    }

    public function lead(Request $request)
    {
        $data = $request->validate([
            'name'    => ['nullable', 'string', 'max:255'],
            'email'   => ['nullable', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'message' => ['nullable', 'string', 'max:5000'],
            'product' => ['nullable', 'string', 'max:255'],
        ]);

        Lead::create($data);

        return response()->json(['ok' => true]);
    }

    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        Subscriber::firstOrCreate(['email' => $data['email']]);

        return response()->json(['ok' => true]);
    }
}
