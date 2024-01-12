<?php

namespace App\Dictionary;

final class ProductCategoryDictionary
{
    public const LAPTOPS = 'laptopy';
    public const COMPUTERS = 'komputery';
    public const MOUSES = 'myszki';

    /**
     * @return string[]
     */
    public static function getProductCategories(): array
    {
        return [
            self::COMPUTERS,
            self::LAPTOPS,
            self::MOUSES,
        ];
    }
}
