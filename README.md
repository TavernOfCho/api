# WowCollection API
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)


## ElasticSearch 

Libaries : 
* friendsofsymfony/elastica-bundle
* elasticsearch/elasticsearch
* api-platform/core:^v2.4.0-beta.1 (ElasticSearch is enabled in this beta)

**Populate elasticsearch** : 
```bash
php bin/console fos:elastica:populate
```

### Troubleshooting :

During the populate, if you have an error similar to this :
``index: /app/user/2 caused blocked by: [FORBIDDEN/12/index read-only / allow delete (api)];
``

Run the following command : 

```bash
curl -XPUT -H "Content-Type: application/json" http://localhost:9200/_all/_settings -d '{"index.blocks.read_only_allow_delete": null}'
```
