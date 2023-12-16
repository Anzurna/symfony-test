<?php

namespace App\Transformer;

use Symfony\Component\Form\Exception\TransformationFailedException;

class CarTransformer implements \Symfony\Component\Form\DataTransformerInterface
{

    /**
     * @inheritDoc
     */
    public function transform(mixed $value): array
    {
        return [
            "id" => $value->getId(),
            "model" => $value->getModel(),
            "brand" => $value->getBrand()->getName(),
            "price" => $value->getPrice(),
            "image" => $value->getImageUrl()
        ];
    }

    /**
     * @inheritDoc
     */
    public function reverseTransform(mixed $value): mixed
    {
        // TODO: Implement reverseTransform() method.
    }
}
