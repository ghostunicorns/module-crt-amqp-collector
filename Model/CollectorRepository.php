<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpCollector\Model;

use Exception;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use GhostUnicorns\CrtAmqpCollector\Api\Data\CollectorInterface;
use GhostUnicorns\CrtAmqpCollector\Api\Data\CollectorSearchResultInterface;
use GhostUnicorns\CrtAmqpCollector\Api\Data\CollectorSearchResultInterfaceFactory;
use GhostUnicorns\CrtAmqpCollector\Api\CollectorRepositoryInterface;
use GhostUnicorns\CrtAmqpCollector\Model\CollectorModelFactory as CollectorFactory;
use GhostUnicorns\CrtAmqpCollector\Model\ResourceModel\Entity\CollectorCollectionFactory;
use GhostUnicorns\CrtAmqpCollector\Model\ResourceModel\CollectorResourceModel;

class CollectorRepository implements CollectorRepositoryInterface
{
    /**
     * @var CollectorFactory
     */
    private $collectorFactory;

    /**
     * @var CollectorCollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CollectorSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectorResourceModel
     */
    private $collectorResourceModel;

    /**
     * @param CollectorModelFactory $collectorFactory
     * @param CollectorCollectionFactory $collectionFactory
     * @param CollectorSearchResultInterfaceFactory $collectorSearchResultInterfaceFactory
     * @param CollectorResourceModel $collectorResourceModel
     */
    public function __construct(
        CollectorFactory $collectorFactory,
        CollectorCollectionFactory $collectionFactory,
        CollectorSearchResultInterfaceFactory $collectorSearchResultInterfaceFactory,
        CollectorResourceModel $collectorResourceModel
    ) {
        $this->collectorFactory = $collectorFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultFactory = $collectorSearchResultInterfaceFactory;
        $this->collectorResourceModel = $collectorResourceModel;
    }

    /**
     * @param int $id
     * @return CollectorInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): CollectorInterface
    {
        $collector = $this->collectorFactory->create();
        $this->collectorResourceModel->load($collector, $id);
        if (!$collector->getId()) {
            throw new NoSuchEntityException(__('Unable to find CrtAmqpCollector with ID "%1"', $id));
        }
        return $collector;
    }

    /**
     * @param CollectorInterface $collector
     * @throws Exception
     */
    public function delete(CollectorInterface $collector)
    {
        $this->collectorResourceModel->delete($collector);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return CollectorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): CollectorSearchResultInterface
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param int $activityId
     * @param string $collectorType
     * @param string $status
     * @throws AlreadyExistsException
     */
    public function createOrUpdate(int $activityId, string $collectorType, string $status)
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(CollectorModel::ACTIVITY_ID, ['eq' => $activityId]);
        $collection->addFieldToFilter(CollectorModel::COLLECTOR_TYPE, ['eq' => $collectorType]);

        /** @var CollectorModel $collector */
        if ($collection->count()) {
            $collector = $collection->getFirstItem();
        } else {
            $collector = $this->collectorFactory->create();
            $collector->setActivityId($activityId);
            $collector->setCollectorType($collectorType);
        }

        $collector->setStatus($status);

        $this->save($collector);
    }

    /**
     * @param CollectorInterface $collector
     * @return CollectorInterface
     * @throws AlreadyExistsException
     */
    public function save(CollectorInterface $collector)
    {
        $this->collectorResourceModel->save($collector);
        return $collector;
    }

    /**
     * @param int $activityId
     * @param string $collectorType
     * @param string $status
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     */
    public function update(int $activityId, string $collectorType, string $status)
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(CollectorModel::ACTIVITY_ID, ['eq' => $activityId]);
        $collection->addFieldToFilter(CollectorModel::COLLECTOR_TYPE, ['eq' => $collectorType]);

        if (!$collection->count()) {
            throw new NoSuchEntityException(__(
                'Non existing collector ~ activityId:%1 ~ collectorType:%2',
                $activityId,
                $collectorType
            ));
        }

        /** @var CollectorInterface $collector */
        $collector = $collection->getFirstItem();
        $collector->setStatus($status);

        $this->save($collector);
    }

    /**
     * @param int $activityId
     * @return CollectorInterface[]
     */
    public function getAllByActivityId(int $activityId): array
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(CollectorModel::ACTIVITY_ID, ['eq' => $activityId]);

        /** @var CollectorInterface[] $collectors */
        $collectors = $collection->getItems();

        return $collectors;
    }
}
