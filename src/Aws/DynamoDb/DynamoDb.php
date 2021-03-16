<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\DynamoDb;

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Marshaler;
use Landingi\AwsBundle\Database\DatabaseClient;
use Landingi\AwsBundle\Database\DatabaseException;

class DynamoDb implements DatabaseClient
{
    private DynamoDbClient $client;
    private Marshaler $marshaler;

    public function __construct(DynamoDbClient $client, Marshaler $marshaler)
    {
        $this->client = $client;
        $this->marshaler = $marshaler;
    }

    /**
     * Example:
     * $dynamoDb->getItem('tableName', ['id' => 2]);
     *
     * @throws DatabaseException
     */
    public function getItem(string $tableName, array $key): array
    {
        $item = $this->client->getItem([
            'TableName' => $tableName,
            'Key' => $this->marshaler->marshalItem($key),
        ]);

        if (!isset($item['Item'])) {
            throw new DatabaseException('Item not found');
        }

        return (array) $this->marshaler->unmarshalItem($item['Item'], false);
    }

    public function updateItem(string $tableName, array $key, array $values): void
    {
        $expressionAttributeNames = [];
        $expressionAttributeValues = [];
        $updateExpression = '';

        foreach ($values as $fieldName => $value) {
            $updateExpression = sprintf('%s#%s = :%s, ', $updateExpression, $fieldName, $fieldName);
            $expressionAttributeValues[sprintf(':%s', $fieldName)] = $this->marshaler->marshalValue($value);
            $expressionAttributeNames[sprintf('#%s', $fieldName)] = $fieldName;
        }

        $this->client->updateItem([
            'TableName' => $tableName,
            'Key' => $this->marshaler->marshalItem($key),
            'UpdateExpression' => sprintf('set %s', rtrim($updateExpression, ', ')),
            'ExpressionAttributeValues' => $expressionAttributeValues,
            'ExpressionAttributeNames' => $expressionAttributeNames,
        ]);
    }
}
