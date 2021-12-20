<?php
namespace Modules\Category\Services;
use App\Traits\UploadTrait;
use Modules\Category\Entities\Trademark;
use Modules\Category\Enum\TrademarkEnum;

class  TrademarkService {

    use UploadTrait;
    public $name;
    public $image;
    public $user_id;

    public function createTrademark()
    {
       return  Trademark::create([
        'name'   => $this->name ,
        'image'  => $this->image ,
        'user_id'=>$this->user_id,
       ]);
    }

    public function updateTrademark(Trademark $trademark)
    {
        $trademark->    update([
            'name'  => $this->name,
            'image' => ($this->image??$trademark->image),
        ]);
        return Trademark::find($trademark->id);
    }
    public function setName($name)
    {
       $this->name =$name;
       return $this;
    }

    public function setImage($image)
    {
        $this->image =$this->storeImage($image,TrademarkEnum::TRADEMARK_IMAGE_PATH);
        return $this;
    }

    public function updateImg($image ,$old_image)
    {
        $this->image =$this->updateImage($image,TrademarkEnum::TRADEMARK_IMAGE_PATH,$old_image);
        return $this;
    }

    public function setUserID($user_id){
        $this->user_id=$user_id;
        return $this;
    }

}
