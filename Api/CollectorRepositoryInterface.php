<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpCollector\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use GhostUnicorns\CrtAmqpCollector\Api\Data\CollectorInterface;
use GhostUnicorns\CrtAmqpCollector\Api\Data\CollectorSearchResultInterface;

interface CollectorRepositoryInterface
{
    /**
     * @param int $id
     * @return CollectorInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): CollectorInterface;

    /**
     * @param CollectorInterface $collector
     * @return CollectorInterface
     */
    public function save(CollectorInterface $collector);

    /**
     * @param CollectorInterface $collector
     * @return void
     */
    public function delete(CollectorInterface $collector);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return CollectorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): CollectorSearchResultInterface;

    /**
     * @param int $activityId
     * @param string $collectorType
     * @param string $status
     */
    public function createOrUpdate(int $activityId, string $collectorType, string $status);

    /**
     * @param int $activityId
     * @param string $collectorType
     * @param string $status
     */
    public function update(int $activityId, string $collectorType, string $status);

    /**
     * @param int $activityId
     * @return CollectorInterface[]
     */
    public function getAllByActivityId(int $activityId): array;
}
