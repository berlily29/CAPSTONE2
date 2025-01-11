<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategories extends Model
{
    public function subcategories(){
        return $this-> hasMany(EventCategories::class, 'parent_id');
    }

    public function parent() {
        return $this-> belongsTo(EventCategories::class, 'parent_id');
    }
}
