# SQS

## ENV

Required `ENV` variables

```dotenv
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
AWS_SQS_ENDPOINT
```

## Production

```yaml
parameters:
    aws.region.west: 'eu-west-1'
    aws.sqs.queue-name: 'queue-name'
    aws.sqs.endpoint: 'https://sqs.eu-west-1.amazonaws.com/000111222333'

services:
    
    aws.credentials:
        class: Aws\Credentials\Credentials
        arguments: ['%env(AWS_ACCESS_KEY_ID)%', '%env(AWS_SECRET_ACCESS_KEY)%']
        
    Landingi\AwsBundle\Aws\Sqs\ClientFactory: ~
    
    aws.sqs.client.west:
        class: Aws\Sqs\SqsClient
        factory: ['Landingi\AwsBundle\Aws\Sqs\ClientFactory', 'build']
        arguments:
            - '@aws.credentials'
            - '%aws.region.west%'

    Landingi\AwsBundle\Aws\Sqs\SqsQueue:
        class: Landingi\AwsBundle\Aws\Sqs\SqsQueue
        arguments:
            - '@aws.sqs.client.west'
            - '%aws.sqs.endpoint%'
            - '%aws.sqs.queue-name%'

    Landingi\AwsBundle\Aws\Sqs\SqsQueueManager:
        class: Landingi\AwsBundle\Aws\Sqs\SqsQueueManager
        arguments:
            - '@aws.sqs.client.west'
            - '%aws.sqs.endpoint%'
            - '%aws.sqs.queue-name%'
```

## Development

```yaml
parameters:
    aws.region.west: 'eu-west-1'
    aws.sqs.queue-name: 'queue-name'
    aws.sqs.endpoint: '%env(AWS_SQS_ENDPOINT)%'

services:
    
    aws.credentials:
        class: Aws\Credentials\Credentials
        arguments: ['%env(AWS_ACCESS_KEY_ID)%', '%env(AWS_SECRET_ACCESS_KEY)%']
        
    Landingi\AwsBundle\Aws\Sqs\ClientFactory: ~
    
    aws.sqs.client.west:
        class: Aws\Sqs\SqsClient
        factory: ['Landingi\AwsBundle\Aws\Sqs\ClientFactory', 'build']
        arguments:
            - '@aws.credentials'
            - '%aws.region.west%'

    Landingi\AwsBundle\Aws\Sqs\SqsQueue:
        class: Landingi\AwsBundle\Aws\Sqs\SqsQueue
        arguments:
            - '@aws.sqs.client.west'
            - '%aws.sqs.endpoint%'
            - '%aws.sqs.queue-name%'

    Landingi\AwsBundle\Aws\Sqs\SqsQueueManager:
        class: Landingi\AwsBundle\Aws\Sqs\SqsQueueManager
        arguments:
            - '@aws.sqs.client.west'
```
