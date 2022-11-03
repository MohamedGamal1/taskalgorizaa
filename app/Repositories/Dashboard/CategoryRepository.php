<?php


namespace App\Repositories\Dashboard;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CategoryRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */


    public function index()
    {
        return $this->model->with('parent')
            ->select('categories.*')
            ->withCount('products')
            //->selectRaw('(SELECT COUNT(*) from products WHERE category_id = categories.id) as product_count')

            /*leftjoin('categories as parents','parents.id','=','categories.parent_id')
            ->select(['categories.*','parents.name as parent_name'])*/

            ->get();
    }
    public function trash()
    {
        return $this->model->onlyTrashed()->leftjoin('categories as parents','parents.id','=','categories.parent_id')

            ->select(['categories.*','parents.name as parent_name'])
            ->get();
    }

    public function create_category()
    {
        return $this->model->all();

    }

    public function store_category($data_request)
    {
        return $this->model->create($data_request);

    }

    public function edit_category($id)
    {
        $data = [];
        $data['category'] = $this->model->findOrFail($id);
        $data['parents'] = $this->model->where('id', '<>', $id)
            ->where(function($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();

        return $data;

    }

    public function update_category($data_request, $id)
    {
        $category = $this->model->find($id);
        return $category->update($data_request);

    }


    public function destroy_category(int $id)
    {
        $category = $this->model->find($id);
        $category->delete();
        if ($category->image)
            Storage::disk('public')->delete($category->image);
    }



    function model(): string
    {
        return "App\Models\Category";
    }


}
