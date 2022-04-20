<?php

namespace App\Filter;

use ApiPlatform\Core\Serializer\Filter\FilterInterface;
use Symfony\Component\HttpFoundation\Request;

class SortFilter implements FilterInterface
{
    public const SORT_FILTER_CONTEXT = 'SORT_FILTER_CONTEXT';
    private array $properties;

    public function __construct(array $properties = [])
    {
        $this->properties = $properties;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(string $resourceClass): array
    {
        if (!$this->properties) {
            return [];
        }
        return [
            'sort' => [
                'property' => null,
                'type' => 'string',
                'required' => false,
                'schema' => [
                    'enum' => array_merge(array_keys($this->properties), array_map(static fn(string $prop) => '-' . $prop, array_keys($this->properties))),
                    'type' => 'array',
                ],
                'openapi' => [
                    'explode' => false,
                ]
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function apply(Request $request, bool $normalization, array $attributes, array &$context): void
    {
        if (!$request->query->get('sort')) {
            return;
        }
        //TODO: filter out properties that are not allowed to be sorted
        $sortParams = explode(',', $request->query->get('sort'));
        foreach ($sortParams as $sortParam) {
            $sortParam = trim($sortParam);
            if (array_key_exists($sortParam, $this->properties)) {
                if (str_starts_with($sortParam, '-')) {
                    $sortParam = substr($sortParam, 1);
                    $context[self::SORT_FILTER_CONTEXT][] = ['field' => $this->properties[$sortParam], 'order' => 'DESC'];
                } else {
                    $context[self::SORT_FILTER_CONTEXT][] = ['field' => $this->properties[$sortParam], 'order' => 'ASC'];
                }
            }
        }
    }
}