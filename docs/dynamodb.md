# DynamoDB

```yaml
parameters:
    aws.region.west: 'eu-west-1'

services:
    
    aws.credentials:
        class: Aws\Credentials\Credentials
        arguments: ['%env(AWS_ACCESS_KEY_ID)%', '%env(AWS_SECRET_ACCESS_KEY)%']

    aws.dynamodb.marshaler:
        class: Aws\DynamoDb\Marshaler

    Landingi\AwsBundle\Aws\DynamoDb\ClientFactory: ~
    
    aws.dynamodb.client.west:
        factory: ['Landingi\AwsBundle\Aws\DynamoDb\ClientFactory', 'build']
        arguments:
            - '@aws.credentials'
            - '%aws.region.west%'

    Landingi\AwsBundle\Aws\DynamoDb:
        class: Landingi\AwsBundle\Aws\DynamoDb
        arguments: ['@aws.dynamodb.client.west', '@aws.dynamodb.marshaler']
```