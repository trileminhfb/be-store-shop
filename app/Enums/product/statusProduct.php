<?php

declare(strict_types=1);

namespace App\Enums\product;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class statusProduct extends Enum
{
    const UNAVAILABLE = 0;
    const AVAILABLE = 1;
}
