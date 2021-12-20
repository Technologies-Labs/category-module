<?php

namespace Modules\Category\Repositories;

use Modules\Category\Entities\Trademark;

class BrandRepository
{
    public function getBrands()
    {
        return Trademark::all();
    }
}
