<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(
            array_map(
                fn($i) => $i['price'] * $i['quantity'],
                $cart
            )
        );

        return view('frontend.carts.checkout', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        $total    = array_sum(
            array_map(
                fn($i) => $i['price'] * $i['quantity'],
                $cart
            )
        );

        Mail::to(Auth::user()->email)
            ->send(new OrderShipped(
                $cart,
                $total
            ));

        History::create([
            'user_id' => Auth::user()->id,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone,
            'name' => Auth::user()->name,
            'price' => $total
        ]);

        session()->forget('cart');

        return redirect()->route('member.dashboard')
            ->with('success', 'Order placed successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
