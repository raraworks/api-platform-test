<?php

namespace App\DataNormalizer;

use App\ApiResource\PersonResource;
use App\DataMapper\PersonResourceDataMapper;
use App\Entity\Person;
use App\Repository\ClientRepository;
use ArrayObject;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

class PersonResourceNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    private const ALREADY_CALLED = 'PERSON_RESOURCE_NORMALIZER';
    protected ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return !isset($context[self::ALREADY_CALLED]) && $data instanceof Person && $context['resource_class'] === PersonResource::class;
    }

    /**
     * @inheritDoc
     */
    public function normalize(mixed $object, string $format = null, array $context = []): float|array|ArrayObject|bool|int|string|null
    {
        return $this->normalizer->normalize((new PersonResourceDataMapper($this->clientRepository))->mapToApiResource(PersonResource::class, $object), $format, $context);
    }
}