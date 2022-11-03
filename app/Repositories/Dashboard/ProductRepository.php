<?php


namespace App\Repositories\Dashboard;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Eloquent\BaseRepository;


class ProductRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */


    public function index()
    {
        return $this->model->with('category')->get();
    }
    public function trash()
    {
        return $this->model->onlyTrashed()->leftjoin('categories as parents','parents.id','=','categories.parent_id')

            ->select(['categories.*','parents.name as parent_name'])
            ->get();
    }

    public function create_product()
    {
        return Category::all();
    }

    public function store_product($data_request)
    {
        return $this->model->create($data_request);

    }

    public function destroy_product(int $id)
    {
        $product = $this->model->find($id);
        $product->delete();
        if ($product->image)
            Storage::disk('public')->delete($product->image);
    }



    function model(): string
    {
        return "App\Models\Product";
    }


}
