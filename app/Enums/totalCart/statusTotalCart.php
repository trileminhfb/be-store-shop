<?php

declare(strict_types=1);

namespace App\Enums\totalCart;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class statusTotalCart extends Enum
{
    const WAITING = 0;
    const DONE = 1;
}
