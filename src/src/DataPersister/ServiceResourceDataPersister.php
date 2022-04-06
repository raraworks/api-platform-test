<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\ApiResource\SpecialityResource;
use Psr\Log\LoggerInterface;
use RuntimeException;

final class ServiceResourceDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof SpecialityResource;
    }

    /**
     * @inheritDoc
     */
    public function persist($data, array $context = [])
    {
        $this->logger->info('Persisted service resource');
    }

    /**
     * @inheritDoc
     * @throws RuntimeException
     */
    public function remove($data, array $context = []): void
    {
        throw new RuntimeException('not supported!');
    }
}