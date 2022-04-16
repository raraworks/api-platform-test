<?php

namespace App\Paginator;

use ApiPlatform\Core\DataProvider\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Exception;
use IteratorAggregate;
use Traversable;

class PersonResourcePaginator implements PaginatorInterface, IteratorAggregate
{
    protected Paginator $paginator;

    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function count(): int
    {
        return iterator_count($this->getIterator());
    }

    /**
     * @inheritDoc
     */
    public function getLastPage(): float
    {
        return 0.0;
    }

    /**
     * @inheritDoc
     */
    public function getTotalItems(): float
    {
        return 240;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentPage(): float
    {
        return (float) $this->paginator->getQuery();
    }

    /**
     * @inheritDoc
     */
    public function getItemsPerPage(): float
    {
        return (float) $this->paginator->getQuery()->getMaxResults();
    }

    public function getIterator(): Traversable
    {
        return $this->paginator->getIterator();
    }
}