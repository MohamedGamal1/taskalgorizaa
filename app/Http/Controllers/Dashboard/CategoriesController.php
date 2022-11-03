<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Dashboard\CategoryRepository as CategoryRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{
    public $categoryRepository;


    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        try {
            $categories = $this->categoryRepository->index();
            return view('dashboard.categories.index', compact('categories'));
        } catch (Exception $e) {
            return redirect()->route('dashboard.dashboard')->with('message', 'something happen please try again ');
        }
    }
    public function trash()
    {
        try {
            $categories = $this->categoryRepository->trash();
            return view('dashboard.categories.trash', compact('categories'));
        } catch (Exception $e) {
            return redirect()->route('dashboard.dashboard')->with('message', 'something happen please try again ');
        }
    }


    public function create()
    {
        try {
            $parents = $this->categoryRepository->create_category();
            $category = new Category();
            return view('dashboard.categories.create', compact('parents', 'category'));
        } catch (Exception $e) {
            return redirect()->route('dashboard.dashboard')->with('message', 'something happen please try again ');
        }
    }


    public function store(CategoryRequest $request)
    {
        //$request->validate($this->categoryRepository->rules());
        $request->merge(['slug' => Str::slug($request->name)]);
        $data_request = $request->except('image');
        $data_request['image'] = $this->uploadImage($request);
        try {

            $category = $this->categoryRepository->store_category($data_request);
            if ($category)
                return redirect()->route('dashboard.categories.index')->with(['success' => ' Category Added Successfully']);

        } catch (Exception $e) {
            return redirect()->route('dashboard.dashboard')->with('info', 'something happen please try again ');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        try {
            $data = $this->categoryRepository->edit_category($id);
            $category = $data['category'];
            $parents = $data['parents'];
            return view('dashboard.categories.edit', compact('category', 'parents'));
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('info', 'Category Not Found');
        }
    }


    public function update(CategoryRequest $request, $id)
    {
        //$clean_data = $request->validate($this->categoryRepository->rules($id));

        $request->merge(['slug' => Str::slug($request->name)]);
        $data_request = $request->except('image');
        $new_path_image = $this->uploadImage($request);
            if ($new_path_image)
                $data_request['image'] = $new_path_image;
        try {
            $category = $this->categoryRepository->edit_category($id);
            $category = $category['category'];
            $old_image = $category->image;

            //////////////////////////////////////
            $category_updated = $this->categoryRepository->update_category($data_request, $id);
            if ($category_updated) {
                if ($old_image && $new_path_image)
                    Storage::disk('public')->delete($old_image);

                return redirect()->route('dashboard.categories.index')->with(['success' => ' Category Updated Successfully']);
            }

        } catch (Exception $e) {
            return redirect()->route('dashboard.dashboard')->with('info', 'something happen please try again ');
        }
    }


    public function destroy($id)
    {
        try {
            $category = $this->categoryRepository->destroy_category($id);

            return redirect()->route('dashboard.categories.index')->with(['success' => ' Category Deleted Successfully']);

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
