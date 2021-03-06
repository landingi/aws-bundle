# SNS

## ENV

Required `ENV` variables

```dotenv
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
```

```yaml
parameters:
    aws.sns.topic: 'example-topic'

services:
    
    aws.credentials:
        class: Aws\Credentials\Credentials
        arguments: ['%env(AWS_ACCESS_KEY_ID)%', '%env(AWS_SECRET_ACCESS_KEY)%']

    Landingi\AwsBundle\Aws\Sns\ClientFactory: ~
    
    aws.sns.client.west:
        class: Aws\Sns\SnsClient
        factory: ['@Landingi\AwsBundle\Aws\Sns\ClientFactory', 'build']
        arguments:
            - '@aws.credentials'
            - '%aws.region.west%'

    Landingi\AwsBundle\Aws\SnsNotification:
        class: Landingi\AwsBundle\Aws\SnsNotification
        arguments: ['@aws.sns.client.west', '%aws.sns.topic%']
```
