<?php

namespace Modules\Newsletter\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Newsletter\Entities\NewsletterSubscriber;

class NewsletterSubscriberController extends Controller
{
    public function verify(Request $request)
    {
        $subscriber = NewsletterSubscriber::where('token', $request->token)->first();

        if ($subscriber) {
            $subscriber->update([
                'is_active' => true,
            ]);

            session()->flash('newsletter_success', 'E-bülten aboneliğiniz başarıyla onaylandı.');
        } else {
            session()->flash('newsletter_error', 'E-bülten aboneliğiniz onaylanamadı. Lütfen tekrar deneyin.');
        }

        return redirect('/#newsletter');
    }
}
