<?php

namespace App\DataNormalizer;

use App\ApiResource\PersonResource;
use App\DataMapper\PersonResourceDataMapper;
use App\Entity\Person;
use InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class ApiResourceSerializer implements ContextAwareNormalizerInterface, ContextAwareDenormalizerInterface, SerializerAwareInterface
{
    protected PersonResourceDataMapper $dataMapper;
    protected NormalizerInterface $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        if (!$decorated instanceof DenormalizerInterface) {
            throw new InvalidArgumentException(sprintf('The decorated normalizer must implement the %s.', DenormalizerInterface::class));
        }
        $this->decorated = $decorated;
        $this->dataMapper = new PersonResourceDataMapper();
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof Person && $context['resource_class'] === PersonResource::class;
    }

    /**
     * @inheritDoc
     */
    public function normalize(mixed $object, string $format = null, array $context = [])
    {
        return $this->decorated->normalize($this->dataMapper->mapToApiResource(PersonResource::class, $object));
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return $this->decorated->supportsDenormalization($data, $type, $format);
    }

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        return $this->decorated->denormalize($data, $type, $format);
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        if ($this->decorated instanceof SerializerAwareInterface) {
            $this->decorated->setSerializer($serializer);
        }
    }
}