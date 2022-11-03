<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['parent_id','name','slug','description','image','status'];

    //protected $guarded = ['id'];
    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','id');
    }
    public function childern()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }
}
