<?php

namespace Modules\CategoryModule\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'order',
        'user_id',
    ];

    // protected static function newFactory()
    // {
    //     return \Modules\CategoryModule\Database\factories\CategoryFactory::new();
    // }

        ////relationships
        public function user(){
        return    $this->belongsTo(User::class);
        }
}
