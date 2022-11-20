<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpCollector\Model;

use Magento\Framework\Api\Search\SearchResult;
use GhostUnicorns\CrtAmqpCollector\Api\Data\CollectorSearchResultInterface;

class CollectorSearchResult extends SearchResult implements CollectorSearchResultInterface
{

}
