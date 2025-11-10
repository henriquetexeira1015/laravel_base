<?php
namespace App\Helpers;

use Illuminate\Support\Str;

class AffiliateCodeHelper
{
    public static function generate(int $user_id, int $product_id): string
    {
        $unique_code = strtoupper(Str::random(5) . $user_id . Str::random(4) . $product_id);

        return $unique_code;
    }
}
