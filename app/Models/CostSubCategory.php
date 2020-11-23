<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostSubCategory extends Model
{
    protected $table = 'costs_sub_categories';

    public function MainCategory()
    {
        return $this->belongsTo(CostCategory::class, 'main_category_id');
    }

}
