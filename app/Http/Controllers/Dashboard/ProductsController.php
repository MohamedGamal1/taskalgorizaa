<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Dashboard\ProductRepository as ProductRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ProductsController extends Controller
{
    public $productRepository;


    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        try {
            $products = $this->productRepository->index();
            return view('dashboard.products.index', compact('products'));
        } catch (Exception $e) {
            return redirect()->route('dashboard.products.index')->with('message', 'something happen please try again ');
        }
    }



    public function create()
    {
        try {
            $parents = $this->productRepository->create_product();
            $product = new Product();
            return view('dashboard.products.create', compact('parents', 'product'));
        } catch (Exception $e) {
            return redirect()->route('dashboard.dashboard')->with('message', 'something happen please try again ');
        }
    }


    public function store(Request $request)
    {
        //$request->validate($this->productRepository->rules());
        $request->merge(['slug' => Str::slug($request->name)]);
        $data_request = $request->except('image');
        $data_request['image'] = $this->uploadImage($request);
        try {

            $product = $this->productRepository->store_product($data_request);
            if ($product)
                return redirect()->route('dashboard.products.index')->with(['success' => ' Product Added Successfully']);

        } catch (Exception $e) {
            return redirect()->route('dashboard.dashboard')->with('info', 'something happen please try again ');
        }
    }


    public function destroy($id)
    {
        try {
            $product = $this->productRepository->destroy_product($id);

            return redirect()->route('dashboard.products.index')->with(['success' => ' Product Deleted Successfully']);

        } catch (Exception $e) {
            return redirect()->route('dashboard.dashboard')->with('info', 'something happen please try again ');
        }
    }

    protected function uploadImage(Request $request)
    {

        if (!$request->hasFile('image'))
            return;

        $file = $request->file('image');
        return $file->store('uploads', 'public');

    }
}
