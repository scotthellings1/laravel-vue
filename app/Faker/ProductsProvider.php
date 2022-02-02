<?php

namespace App\Faker;

use Faker\Provider\Base;

class ProductsProvider extends Base
{
    protected static $names = [
        'Door single',
        'Door Double',
        'Counter Top',
        'Plaster',
        'Timber',
        'Cabinet SM',
        'Cabinet MD',
        'Cabinet LG',
        'Cabinet XL',
        'Concrete',
        'Sand',
        'Bricks',
        'Blocks',
        'RSJ',
        'Tiles',
        'Laminate Flooring',
        'Skirting Board',
        'Ply Wood',
    ];

    public function product(): string
    {
        return static::randomElement(static::$names);
    }
}
