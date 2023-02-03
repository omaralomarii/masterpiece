<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = cart::all();
        return view('Cart', ['cart' => $cart]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = auth()->id();
        $cartDB = cart::where('user_id', $userId)->where('product_id', $request->product_id)->get();
        if (!empty($cartDB[0])) {
            $updateCart = cart::find($cartDB[0]->id);
            $updateCart->quantity += 1;
            $updateCart->save();
            return Redirect()->back();
        }
        $cart = new cart();
        $cart->user_id = $userId;
        $cart->product_id = $request->product_id;
        $cart->price = $request->price;
        $cart->save();
        return Redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update($id, $quantity)
    {
        $cart = cart::find($id);
        $cart->quantity = $quantity;
        $cart->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        //
    }


    public function checkout()
    {
        $userId = auth()->id();
        $cart = cart::where('user_id', $userId)->get();
        return view('CheckOut', ['cart' => $cart]);
    }
}
