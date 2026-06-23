<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Catalog;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::published()->orderBy('order_column')->get();

        seo()->title('Kataloglar')->description('Kalyon İnşaat dijital kataloglarını indirin.');

        return view('frontend.pages.catalog.index', compact('catalogs'));
    }
}
