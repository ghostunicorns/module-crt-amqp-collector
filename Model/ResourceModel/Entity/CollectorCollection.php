<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpCollector\Model\ResourceModel\Entity;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use GhostUnicorns\CrtAmqpCollector\Model\CollectorModel;
use GhostUnicorns\CrtAmqpCollector\Model\ResourceModel\CollectorResourceModel;

class CollectorCollection extends AbstractCollection
{
    protected $_idFieldName = 'collector_id';
    protected $_eventPrefix = 'crt_amqp_collector_collection';
    protected $_eventObject = 'collector_collection';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CollectorModel::class, CollectorResourceModel::class);
    }
}
