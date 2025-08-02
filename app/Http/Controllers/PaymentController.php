<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Product;

use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function index(){

    }

    public function create(){

    }

    public function store(Request $request){

    }


    public function show(string $id){

    }

    public function edit(string $id){

    }

    public function update(Request $request, string $id){

    }

    public function destroy(string $id){

    }

    public function checkout(Request $request){
        Stripe::setApiKey(config('services.stripe.secret'));

        $cart = Cart::where('user_id',auth()->id())->with('product')->get();

        if($cart->isEmpty()){
            return redirect()->back()->with('error','Tu carrito está vacío');
        }

        $lineItems = [];

        foreach ($cart as $item) {
            $lineItems[] =[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => intval($item->price * 100),
                ],
                'quantity' => $item->quantity,
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel')
        ]);

        return redirect($session->url);
    }

    public function success(){
        return view('cart.success');
    }

    public function cancel(){
        return view('cart.cancel');
    }
}
