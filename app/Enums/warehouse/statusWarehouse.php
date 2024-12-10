<?php

declare(strict_types=1);

namespace App\Enums\warehouse;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class statusWarehouse extends Enum
{
    const UNAVAILABLE = 0;
    const AVAILABLE = 1;
}
