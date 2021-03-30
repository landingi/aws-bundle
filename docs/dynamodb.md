# DynamoDB

## ENV

Required `ENV` variables

```dotenv
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
AWS_DYNAMODB_ENDPOINT
```

```yaml
parameters:
    aws.region.west: 'eu-west-1'
    aws.dynamodb.table-name: 'table-name'
    aws.dynamodb.endpoint: '%env(AWS_DYNAMODB_ENDPOINT)%'

services:
    
    aws.credentials:
        class: Aws\Credentials\Credentials
        arguments: ['%env(AWS_ACCESS_KEY_ID)%', '%env(AWS_SECRET_ACCESS_KEY)%']

    aws.dynamodb.marshaler:
        class: Aws\DynamoDb\Marshaler

    Landingi\AwsBundle\Aws\DynamoDb\ClientFactory: ~
    
    aws.dynamodb.client.west:
        class: Aws\DynamoDb\DynamoDbClient
        factory: ['@Landingi\AwsBundle\Aws\DynamoDb\ClientFactory', 'build']
        arguments:
            - '@aws.credentials'
            - '%aws.region.west%'
            - '%aws.dynamodb.endpoint%'

    Landingi\AwsBundle\Aws\DynamoDb\DynamoDb:
        class: Landingi\AwsBundle\Aws\DynamoDb\DynamoDb
        arguments:
            - '@aws.dynamodb.client.west'
            - '@aws.dynamodb.marshaler'
            - '%aws.dynamodb.table-name%'
```
