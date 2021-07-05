<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery;

final class OrFilterQueryCollection extends FilterQueryCollection
{
    protected function getOperator(): string
    {
        return 'or';
    }
}
