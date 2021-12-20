<?php

namespace Modules\Category\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trademark extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'image',
        'user_id'
    ];

    // protected static function newFactory()
    // {
    //     return \Modules\Category\Database\factories\TrademarkFactory::new();
    // }

    ////relations
    public function user(){
       return $this->belongsTo(User::class);
    }
}
