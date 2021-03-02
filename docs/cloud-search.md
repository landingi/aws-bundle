# Cloud Search

```yaml
parameters:
    aws.region.west: 'eu-west-1'
    aws.cloud-search.endpoint: 'https://endpoint.region.cloudsearch.amazonaws.com'

services:
    
    aws.credentials:
        class: Aws\Credentials\Credentials
        arguments: ['%env(AWS_ACCESS_KEY_ID)%', '%env(AWS_SECRET_ACCESS_KEY)%']
    
    aws.cloud-search.client.west:
        factory: ['Landingi\AwsBundle\Aws\CloudSearch\ClientFactory', 'build']
        arguments:
            - '@aws.credentials'
            - '%aws.region.west%'
            - '%aws.cloud-search.endpoint%'

    Landingi\AwsBundle\Aws\CloudSearch:
        class: Landingi\AwsBundle\Aws\CloudSearch
        arguments: ['@aws.cloud-search.client.west']
```
