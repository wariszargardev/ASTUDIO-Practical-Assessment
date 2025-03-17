<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AttributeTypeEnum extends Enum
{
    const TEXT = 'text';
    const DATE = 'date';
    const NUMBER = 'number';
    const SELECT = 'select';

    public static function values(): array
    {
        return [
            self::TEXT,
            self::DATE,
            self::NUMBER,
            self::SELECT
        ];
    }
}
