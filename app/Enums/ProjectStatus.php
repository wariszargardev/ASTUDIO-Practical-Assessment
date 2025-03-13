<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProjectStatus extends Enum
{
    const Active = 'active';
    const Inactive = 'inactive';
    const Completed = 'completed';
}
