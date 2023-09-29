<?php

declare(strict_types=1);

namespace App\Enum;

enum CartStatus: string
{
    case PLACED = 'placed';

    case CANCELED = 'canceled';

    case PENDING = 'pending';

    case CREATED = 'created';

    case SHIPPED = 'shipped';

    case CLOSED = 'closed';
}
