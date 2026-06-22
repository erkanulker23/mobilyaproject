<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /** Footer e-bülten aboneliği. */
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        Subscriber::firstOrCreate(['email' => $data['email']]);

        if ($request->expectsJson()) {
            return response()->json(['ok' => true]);
        }

        return back()->with('subscribed', true);
    }
}
