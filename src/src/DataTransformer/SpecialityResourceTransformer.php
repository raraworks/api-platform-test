<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\ApiResource\SpecialityResource;
use App\Entity\Speciality;

class SpecialityResourceTransformer implements DataTransformerInterface
{

    /**
     * @inheritDoc
     */
    public function transform($object, string $to, array $context = [])
    {
        if ($object instanceof Speciality) {
            $return = new SpecialityResource();
            $return->id = $object->getId();
            $return->title = $object->getTitle();
            $return->slug = $object->getSlug();
            $return->description = $object->getDescription();
            $return->position = $object->getPosition();
            return $return;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return SpecialityResource::class === $to && $data instanceof Speciality;
    }
}