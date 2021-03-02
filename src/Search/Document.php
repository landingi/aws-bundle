<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Search;

final class Document
{
    private DocumentIdentifier $identifier;

    /**
     * @var DocumentField[]
     */
    private array $fields;

    public function __construct(DocumentIdentifier $identifier, DocumentField... $fields)
    {
        $this->identifier = $identifier;
        $this->fields = $fields;
    }

    public function getIdentifier(): DocumentIdentifier
    {
        return $this->identifier;
    }

    public function getFields(): array
    {
        $result = [];

        foreach ($this->fields as $field) {
            $result[$field->getKey()] = $field->getValue();
        }

        return $result;
    }
}
