<?php
namespace Modules\Category\Services;
use App\Traits\UploadTrait;
use Modules\Category\Entities\Category;
use Modules\Category\Enum\CategoryEnum;

use function PHPUnit\Framework\isNull;

class  CategoryService {

    use UploadTrait;
    public $name;
    public $image;
    public $order;
    public $user_id;

    public function createCategory()
    {
       return  Category::create([
        'name'   => $this->name ,
        'image'  => $this->image ,
        'order'  => $this->order ,
        'user_id'=>$this->user_id,
       ]);
    }

    public function updateCategory(Category $category)
    {
        $category->    update([
            'name'  => $this->name,
            'image' => ($this->image??$category->image),
            'order' => $this->order ,
           ]);
        return Category::find($category->id);
    }
    public function setName($name)
    {
       $this->name =$name;
       return $this;
    }

    public function setOrder($order)
    {
       $this->order =$order;
       return $this;
    }
    public function setImage($image)
    {
        $this->image =$this->storeImage($image,CategoryEnum::CATEGORY_IMAGE_PATH);
        return $this;
    }

    public function updateImg($image ,$old_image)
    {
        $this->image =$this->updateImage($image,CategoryEnum::CATEGORY_IMAGE_PATH,$old_image);
        return $this;
    }

    public function setUserID($user_id){
        $this->user_id=$user_id;
        return $this;
    }

}
