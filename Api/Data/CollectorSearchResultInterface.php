<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpCollector\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CollectorSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return CollectorInterface[]
     */
    public function getItems();

    /**
     * @param CollectorInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
