<?php

declare(strict_types=1);

namespace App\Enums\gender;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class gender extends Enum
{
    const WOMEN = 0;
    const MEN = 1;
}
