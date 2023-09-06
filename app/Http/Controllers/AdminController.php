<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Order;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function add_product()
    {
        return view('admin.menu.create');
    }
    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required'
        ]);

        $file = $request->file('image');
        $path = time().'_'.$request->name.'.'.$file->getClientOriginalExtension();
        Storage::disk('local')->put('public/'.$path, file_get_contents($file));

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $path
        ]);

        if($product)
        {
            return redirect()->route('show_product')->with('message', 'produk berhasil ditambahkan');
        }else{
            return redirect()->route('show_product')->with('failed', 'produk gagal ditambahkan');
        }



    }
    public function show_product()
    {
        $products = Product::all();
        return view('admin.menu.products', compact('products'));
    }
    public function edit(Product $product)
    {
        return view('admin.menu.edit', compact('product'));
    }
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required'
        ]);
        $file = $request->file('image');
        $path = time().'_'.$request->name.'.'.$file->getClientOriginalExtension();
        Storage::disk('local')->put('public/'.$path, file_get_contents($file));

        $edit = $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $path
        ]);
        if($edit)
        {
            return redirect()->route('show_product')->with('message', 'produk berhasil ditambahkan');
        }else{
            return redirect()->route('show_product')->with('failed', 'produk gagal ditambahkan');
        }
    }
    public function delete(Product $product)
    {
        $delete = $product->delete();
        if($delete)
        {
            return redirect()->route('show_product')->with('message', 'produk berhasil dihapus');
        }else{
            return redirect()->route('show_product')->with('failed', 'produk gagal dihapus');
        }

    }
    public function orders()
    {
        $order = Order::all();
        return view('admin.menu.order', compact('order'));
    }
    public function confirm($id){
        $order = Order::find($id);
        $order->update([
            'is_paid' => true
        ]);
        return redirect()->route('orders');
    }

}
