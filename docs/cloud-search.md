# Cloud Search

## ENV

Required `ENV` variables

```dotenv
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
```

```yaml
parameters:
    aws.region.west: 'eu-west-1'
    aws.cloud-search.endpoint: 'https://endpoint.region.cloudsearch.amazonaws.com'

services:
    
    aws.credentials:
        class: Aws\Credentials\Credentials
        arguments: ['%env(AWS_ACCESS_KEY_ID)%', '%env(AWS_SECRET_ACCESS_KEY)%']
        
    Landingi\AwsBundle\Aws\CloudSearch\ClientFactory: ~
    
    aws.cloud-search.client.west:
        class: Aws\CloudSearchDomain\CloudSearchDomainClient
        factory: ['@Landingi\AwsBundle\Aws\CloudSearch\ClientFactory', 'build']
        arguments:
            - '@aws.credentials'
            - '%aws.region.west%'
            - '%aws.cloud-search.endpoint%'

    Landingi\AwsBundle\Aws\CloudSearch:
        class: Landingi\AwsBundle\Aws\CloudSearch
        arguments: ['@aws.cloud-search.client.west']
```
