# SQS

```yaml
parameters:
    aws.region.west: 'eu-west-1'
    aws.sqs.queue-name: 'queue-name'

services:
    
    aws.credentials:
        class: Aws\Credentials\Credentials
        arguments: ['%env(AWS_ACCESS_KEY_ID)%', '%env(AWS_SECRET_ACCESS_KEY)%']
    
    aws.sqs.client.west:
        factory: ['Landingi\AwsBundle\Aws\Sqs\ClientFactory', 'build']
        arguments:
            - '@aws.credentials'
            - '%aws.region.west%'

    Landingi\AwsBundle\Aws\SqsQueue:
        class: Landingi\AwsBundle\Aws\SqsQueue
        arguments: ['@aws.s3.client.west', '%aws.sqs.queue-name%']
```
