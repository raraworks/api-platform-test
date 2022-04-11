<?php

namespace App\Normalizers;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SpecialityResourceNormalizer implements NormalizerInterface
{

    /**
     * @inheritDoc
     */
    public function normalize(mixed $object, string $format = null, array $context = [])
    {
        // TODO: Implement normalize() method.
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization(mixed $data, string $format = null)
    {
        // TODO: Implement supportsNormalization() method.
    }
}