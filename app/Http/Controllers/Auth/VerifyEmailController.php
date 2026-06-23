<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request, $id, $hash): RedirectResponse
    {
        $user = $request->user();
        // if user not logged in then authenticate user
        if (! $user) {
            $user = \App\Models\User::findOrFail($id);
            auth()->login($user);
        }

        if (! hash_equals(sha1($user->getEmailForVerification()), (string) $hash)) {
            flash()->addError('Doğrulama işlemi başarısız.', 'Doğrulama');

            return redirect()->intended('/');
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        flash()->addSuccess('E-posta adresiniz doğrulandı.', 'Doğrulama');

        return redirect()->intended('/');
    }
}
