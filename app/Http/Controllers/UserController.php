<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\alert;

class UserController extends Controller
{
    public function beranda(User $user)
    {
        $products = Product::all();
        return view('user.index', compact('products', 'user'));
    }
    public function detail(Product $product)
    {
        return view('user.detail', compact('product'));
    }
    public function register()
    {
        return view('user.auth.register');
    }
    public function signup(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);
    $data['password'] = Hash::make($request->password);

    $signup = User::create($data);
    if($signup){
        return redirect()->route('register')->with('register', 'Data berhasil di tambahkan');
    }else{
        return redirect()->route('register')->with('failed', 'Data gagal di tambahkan');
    }

    }
    public function login()
    {
        return view('user.auth.login');
    }
    public function signin(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        if(Auth::attempt($data)){
            return redirect()->route('beranda');
        }else{
            return redirect()->route('login')->with('login', 'Username atau password salah');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function add_cart(Request $request, Product $product)
    {
        $user_id = Auth::id();
        $product_id = $product->id;

        $Cart = Cart::create([
            'product_id' => $product_id,
            'user_id' => $user_id,
            'amount' => $request->amount
        ]);
        if($Cart)
        {
            return redirect()->route('detail', $product)->with('cart', 'Produk berhasil masuk ke keranajang');
        }else{
            return redirect()->route('detail', $product)->with('cart', 'Produk gagal masuk ke keranajang');
        }

    }
    public function carts()
    {
        $carts = Cart::all();
        return view('user.carts', compact('carts'));
    }
    public function checkout(Order $order)
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();

        if($carts == null)
        {
            return redirect()->route('carts');
        }

        $order = Order::create([
            'user_id' => $user_id
        ]);
        foreach($carts as $cart)
        {
            Transaction::create([
                'amount' => $cart->amount,
                'product_id' => $cart->product_id,
                'order_id' => $order->id
            ]);
            $cart->delete();
        }
        return redirect()->route('/order/{id}');

    }
    public function order_user(Order $order)
    {
        return view('user.order', compact('order'));
    }
    public function payment(Order $order, Request $request)
    {
        $file = $request->file('file');
        $path = time().'_'.$order->id.'.'.$file->getClientOriginalExtension();
        Storage::disk('local')->put('public/'.$path, file_get_contents($file));
        $order->update([
            'payment_recipe' => $path
        ]);

        return redirect('order/{order->id}');
    }
}
