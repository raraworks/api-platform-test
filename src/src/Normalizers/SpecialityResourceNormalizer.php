<?php

namespace App\Normalizers;

use App\ApiResource\SpecialityResource;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class SpecialityResourceNormalizer implements NormalizerInterface
{
    protected ObjectNormalizer $baseNormalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->baseNormalizer = $normalizer;
    }

    /**
     * @inheritDoc
     */
    public function normalize(mixed $object, string $format = null, array $context = [])
    {
        $data = $this->baseNormalizer->normalize($object, $format, $context);
        $data['consultations'] = $object->getConsultations();
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization(mixed $data, string $format = null)
    {
        return $data instanceof SpecialityResource;
    }
}