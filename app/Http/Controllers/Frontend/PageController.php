<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Dealer;
use App\Models\Lead;
use App\Models\News;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends FrontendController
{
    public function corporate()
    {
        $this->boot();

        return view('frontend.corporate');
    }

    public function collection(?string $slug = null)
    {
        $this->boot();

        $categories = Category::orderBy('sort')->get();
        $active = $slug ? $categories->firstWhere('slug', $slug) : $categories->first();

        $products = Product::with('category')
            ->when($active, fn ($q) => $q->where('category_id', $active->id))
            ->orderBy('sort')
            ->get();

        return view('frontend.collection', compact('categories', 'active', 'products'));
    }

    public function product(string $slug)
    {
        $this->boot();

        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        $related = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->orderBy('sort')->take(3)->get();

        return view('frontend.product', compact('product', 'related'));
    }

    public function news()
    {
        $this->boot();

        $news = News::orderBy('sort')->get();

        return view('frontend.news', compact('news'));
    }

    public function article(string $slug)
    {
        $this->boot();

        $article = News::where('slug', $slug)->firstOrFail();
        $related = News::where('id', '!=', $article->id)->orderBy('sort')->take(3)->get();

        return view('frontend.article', compact('article', 'related'));
    }

    public function dealers()
    {
        $this->boot();

        $dealers = Dealer::orderBy('sort')->get();

        return view('frontend.dealers', compact('dealers'));
    }

    public function contact()
    {
        $this->boot();

        return view('frontend.contact');
    }

    public function contactSubmit(Request $request)
    {
        $data = $request->validate([
            'name'    => ['nullable', 'string', 'max:255'],
            'email'   => ['nullable', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        Lead::create($data);

        return back()->with('sent', true);
    }

    public function faq()
    {
        $this->boot();

        $faqs = \App\Models\Faq::where('is_active', true)->orderBy('sort')->get();

        return view('frontend.faq', compact('faqs'));
    }

    public function search(Request $request)
    {
        $this->boot();

        $q = trim((string) $request->get('q', ''));
        $results = collect();
        if ($q !== '') {
            $results = Product::with('category')
                ->where(fn ($w) => $w->where('tr', 'like', "%$q%")->orWhere('en', 'like', "%$q%"))
                ->orderBy('sort')->get();
        }

        return view('frontend.search', compact('q', 'results'));
    }

    public function legal(string $slug)
    {
        $this->boot();

        $page = Page::where('key', $slug)->firstOrFail();

        return view('frontend.legal', compact('page'));
    }
}
