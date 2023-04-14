<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public $viewPath = "products.";
    /**
     * product list
     *
     * @return View
     * @author BV
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(5);

        return view("$this->viewPath.index", compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'sku'   => 'required',
            'name'   => 'required',
            'detail' => 'required',
        ]);

        //Product::create($request->all());

        $product = new Product();
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * edit product
     *
     * @param integer $productId
     * @return View
     * @author BV
     */
    public function edit(int $productId): View
    {
        $product = Product::find($productId);
        return view('products.edit', compact('product'));
    }

    /**
     * update product
     *
     * @param Request $request
     * @param integer $productId
     * @return RedirectResponse
     * @author BV
     */
    public function update(Request $request,int $productId): RedirectResponse
    {
        $request->validate([
            'sku'   => 'required',
            'name'   => 'required',
            'detail' => 'required',
        ]);

        $product = Product::find($productId);
        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * delete method
     *
     * @param integer $productId
     * @return RedirectResponse
     * @author BV
     */
    public function destroy(int $productId): RedirectResponse
    {
        $product = Product::find($productId);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
