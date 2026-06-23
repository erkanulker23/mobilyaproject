<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Cart\Services\CartService;

class CartHasAtLeastOneItemMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $cartService = app(CartService::class);

        if ($cartService->isEmpty()) {
            flash()->addError('Sepetinizde ürün bulunmamaktadır!', 'Hata');

            return redirect()->route('cart.index');
        }

        return $next($request);
    }
}
