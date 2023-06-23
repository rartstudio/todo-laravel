<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TodoPriority extends Enum
{
    const Low = 0;
    const Medium = 1;
    const High = 2;
}
