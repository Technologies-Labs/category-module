<?php

namespace Modules\CategoryModule\Repositories;

use Modules\CategoryModule\Entities\Trademark;

class BrandRepository
{
    public function getBrands()
    {
        return Trademark::all();
    }
}
