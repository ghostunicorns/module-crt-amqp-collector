<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpCollector\Api\Data;

use DateTime;
use Exception;
use Magento\Framework\Api\ExtensibleDataInterface;

interface CollectorInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getActivityId(): int;

    /**
     * @param int $activityId
     * @return void
     */
    public function setActivityId(int $activityId);

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @param string $status
     * @return void
     */
    public function setStatus(string $status);

    /**
     * @return string
     */
    public function getCollectorType(): string;

    /**
     * @param string $collectorType
     * @return void
     */
    public function setCollectorType(string $collectorType);

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getCreatedAt(): DateTime;

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getUpdatedAt(): DateTime;
}
