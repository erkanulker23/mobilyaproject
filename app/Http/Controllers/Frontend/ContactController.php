<?php

namespace App\Http\Controllers\Frontend;

use App\DTOs\Branch\BranchData;
use App\Events\ContactFormSubmissionCreated;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ContactFormSubmission;
use App\Notifications\User\ContactUsNotification;
use App\Settings\ImageSettings;
use App\Settings\SeoSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $branches = BranchData::collection(Branch::all());

        $seoSettings = app(SeoSettings::class);
        $imageSettings = app(ImageSettings::class);

        seo()
            ->title($seoSettings->contact_title)
            ->description($seoSettings->contact_description)
            ->url($request->fullUrl());

        // Get hero banner images with fallback to default images
        $heroImage = $imageSettings->contact_hero
            ? url(Storage::url($imageSettings->contact_hero))
            : url(Storage::url('default_images/contact_hero.webp'));
        $heroImageMobile = $imageSettings->contact_hero_mobile
            ? url(Storage::url($imageSettings->contact_hero_mobile))
            : url(Storage::url('default_images/contact_hero_mobile.webp'));

        return view('frontend.pages.contact.index', [
            'branches' => $branches,
            'heroImage' => $heroImage,
            'heroImageMobile' => $heroImageMobile,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required|string|max:255',
        ]);

        // 1) Kayıt her durumda saklanır (mail gönderiminden bağımsız).
        try {
            $contactForm = ContactFormSubmission::create($request->only([
                'name',
                'phone',
                'email',
                'message',
            ]));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('İletişim formu kaydedilemedi: '.$e->getMessage());
            flash()->addError('Bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.', 'Hata!');

            return redirect()->route('contact.index');
        }

        // 2) Bildirim/mail başarısız olsa bile kayıt korunur.
        try {
            ContactFormSubmissionCreated::dispatch($contactForm);

            Notification::route('mail', $request->email)
                ->notify(new ContactUsNotification($contactForm));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('İletişim formu bildirimi gönderilemedi: '.$e->getMessage());
        }

        return redirect()->route('contact.index')->with('success', 'Mesajınızı aldık! En kısa sürede size geri dönüş sağlayacağız.');
    }
}
