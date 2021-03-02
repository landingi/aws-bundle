<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Search;

interface SearchClient
{
    public function upload(Document ...$documents): void;
    public function delete(DocumentIdentifier ...$documentIds): void;
}
