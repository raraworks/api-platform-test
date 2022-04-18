<?php

namespace App\DataNormalizer;

use App\ApiResource\ClientResource;
use App\DataMapper\ClientResourceDataMapper;
use App\Entity\Client;
use ArrayObject;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

class ClientResourceNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    private const ALREADY_CALLED = 'CLIENT_RESOURCE_NORMALIZER';

    /**
     * @inheritDoc
     */
    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return !isset($context[self::ALREADY_CALLED]) && $data instanceof Client && $context['resource_class'] === ClientResource::class;
    }

    /**
     * @inheritDoc
     */
    public function normalize(mixed $object, string $format = null, array $context = []): float|array|ArrayObject|bool|int|string|null
    {
        return $this->normalizer->normalize((new ClientResourceDataMapper())->mapToApiResource(ClientResource::class, $object), $format, $context);
    }
}