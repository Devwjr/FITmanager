<?php

namespace App;

use App\Models\Constants\ActivityType;
use App\Models\Constants\StatusType;

/**
 * @deprecated Use App\Models\Constants\StatusType and App\Models\Constants\ActivityType instead.
 */
class Constants
{
    const STATUS_ACTIVE = StatusType::ACTIVE;

    const STATUS_INACTIVE = StatusType::INACTIVE;

    const STATUS_DELETED = StatusType::DELETED;

    const STATUS_SUSPENDED = StatusType::SUSPENDED;

    const STATUS_EXPIRED = StatusType::EXPIRED;

    const ACTIVITY_ATTENDANCE = ActivityType::ATTENDANCE;

    const ACTIVITY_SYSTEM = ActivityType::SYSTEM;
}
