<?php

namespace App\Enums\invoice;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusInvoice extends Enum
{
    const WAITING = 0;
    const DONE = 1;
}
