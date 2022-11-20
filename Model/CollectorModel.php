<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpCollector\Model;

use DateTime;
use Exception;
use Magento\Framework\DataObject;
use Magento\Framework\Model\AbstractExtensibleModel;
use GhostUnicorns\CrtAmqpCollector\Api\Data\CollectorInterface;

class CollectorModel extends AbstractExtensibleModel implements CollectorInterface
{
    const ID = 'collector_id';
    const ACTIVITY_ID = 'activity_id';
    const COLLECTOR_TYPE = 'collector_type';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const CACHE_TAG = 'crt_amqp_collector';
    protected $_cacheTag = 'crt_amqp_collector';
    protected $_eventPrefix = 'crt_amqp_collector';

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int
     */
    public function getActivityId(): int
    {
        return (int)$this->getData(self::ACTIVITY_ID);
    }

    /**
     * @param int $activityId
     * @return void
     */
    public function setActivityId(int $activityId)
    {
        $this->setData(self::ACTIVITY_ID, $activityId);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return (string)$this->getData(self::STATUS);
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @return string
     */
    public function getCollectorType(): string
    {
        return (string)$this->getData(self::COLLECTOR_TYPE);
    }

    /**
     * @param string $collectorType
     */
    public function setCollectorType(string $collectorType)
    {
        $this->setData(self::COLLECTOR_TYPE, $collectorType);
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->getData(self::CREATED_AT));
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getUpdatedAt(): DateTime
    {
        return new DateTime($this->getData(self::UPDATED_AT));
    }

    protected function _construct()
    {
        $this->_init(ResourceModel\CollectorResourceModel::class);
    }
}
