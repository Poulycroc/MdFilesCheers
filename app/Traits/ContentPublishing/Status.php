<?php
/**
 * class Status.
 *
 * @version    1.0.0
 *
 * @doc        https://github.com/Bizly/laravel-content-publishing
 *
 * @author     Tor Miller
 * @copyright  (c) 2015-2017, Bizly, Inc., All Rights Reserved
 */

namespace App\Traits\ContentPublishing;

class Status
{
    const DRAFTED = 5;
    const SUBMITTED = 4;
    const REJECTED = 3;
    const APPROVED = 2;
    const PUBLISHED = 1;
    const ARCHIVED = 0;

    const STATUS_LIST = [
        5 => 'DRAFTED',
        4 => 'SUBMITTED',
        3 => 'REJECTED',
        2 => 'APPROVED',
        1 => 'PUBLISHED',
        0 => 'ARCHIVED',
    ];

    public function getStatus(int $id = 0): string
    {
        return self::STATUS_LIST[$id];
    }

    public function getStatusFromName(string $name = 'DRAFTED'): int
    {
        return array_search(strtoupper($name), self::STATUS_LIST);
    }
}
