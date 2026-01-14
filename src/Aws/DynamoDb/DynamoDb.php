<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\DynamoDb;

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Marshaler;
use Landingi\AwsBundle\Aws\DynamoDb\KeyCriteria\ExclusiveStartKey;
use Landingi\AwsBundle\Database\DatabaseException;
use Landingi\AwsBundle\Database\ExactKeyCriteria;
use Landingi\AwsBundle\Database\KeyCriteria;
use Landingi\AwsBundle\Database\KeyValueDatabaseClient;

use function json_encode;
use function rtrim;
use function sprintf;

class DynamoDb implements KeyValueDatabaseClient
{
    public function __construct(
        private readonly DynamoDbClient $client,
        private readonly Marshaler $marshaler,
        private readonly string $tableName,
    ) {
    }

    /**
     * Example:
     * $dynamoDb->getItem(['id' => 2]);.
     *
     * @throws \Landingi\AwsBundle\Database\DatabaseException
     * @throws \JsonException
     */
    public function get(array $key): array
    {
        $item = $this->client->getItem([
            'TableName' => $this->tableName,
            'Key' => $this->marshaler->marshalItem($key),
        ]);

        if (!isset($item['Item'])) {
            throw new DatabaseException(
                sprintf(
                    'Item for key (%s) not found in (%s) table',
                    json_encode($key, JSON_THROW_ON_ERROR),
                    $this->tableName,
                ),
            );
        }

        return (array) $this->marshaler->unmarshalItem($item['Item'], false);
    }

    public function query(
        KeyCriteria $key,
        int $limit,
        ?string $indexName = null,
        ?ExactKeyCriteria $offsetKey = null,
    ): array {
        $options = ['Limit' => $limit];

        if ($offsetKey instanceof ExclusiveStartKey) {
            $options['ExclusiveStartKey'] = $this->marshaler->marshalItem($offsetKey->toKeyValueArray());
        }

        $result = $this->client->query(array_merge(
            ['TableName' => $this->tableName],
            is_string($indexName) ? ['IndexName' => $indexName] : [],
            $this->buildKeyConditions($key),
            $options,
        ))->get('Items');

        if (empty($result)) {
            return [];
        }

        return array_map(fn(array $item) => $this->marshaler->unmarshalItem($item), $result);
    }

    public function update(array $key, array $values): void
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
            'TableName' => $this->tableName,
            'Key' => $this->marshaler->marshalItem($key),
            'UpdateExpression' => sprintf('set %s', rtrim($updateExpression, ', ')),
            'ExpressionAttributeValues' => $expressionAttributeValues,
            'ExpressionAttributeNames' => $expressionAttributeNames,
        ]);
    }

    public function delete(array $key): void
    {
        $this->client->deleteItem([
            'TableName' => $this->tableName,
            'Key' => $this->marshaler->marshalItem($key),
        ]);
    }

    public function put(array $item): void
    {
        $this->client->putItem([
            'TableName' => $this->tableName,
            'Item' => $this->marshaler->marshalItem($item),
        ]);
    }

    private function buildKeyConditions(KeyCriteria $criteria): array
    {
        $conditions = [];
        $expressions = [];

        foreach ($criteria->getConditions() as $condition) {
            $placeholder = ":{$condition->getKey()}";
            $conditions[] = "({$condition->getKey()} {$condition->getOperator()} $placeholder)";
            $expressions[$placeholder] = $this->marshaler->marshalValue($condition->getValue());
        }

        return [
            'KeyConditionExpression' => implode(' and ', $conditions),
            'ExpressionAttributeValues' => $expressions,
        ];
    }
}
