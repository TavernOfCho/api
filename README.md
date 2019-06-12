# TavernOfCho API

[![Build Status](https://api.travis-ci.com/TavernOfCho/api.svg?branch=develop)](https://travis-ci.org/okty-io/okty-server) 
[![Coverage Status](https://coveralls.io/repos/github/TavernOfCho/api/badge.svg?branch=develop)](https://coveralls.io/github/Tavernofcho/api?branch=develop)


## ElasticSearch 

Libaries : 
* friendsofsymfony/elastica-bundle
* elasticsearch/elasticsearch
* api-platform/core:^v2.4.0-beta.1 (ElasticSearch is enabled in this beta)

**Populate elasticsearch** : 
```bash
php bin/console fos:elastica:populate
```

**Populate the database (fixtures)**
```bash
php bin/console hautelook:fixtures:load
```

### Troubleshooting :

During the populate, if you have an error similar to this :
``index: /app/user/2 caused blocked by: [FORBIDDEN/12/index read-only / allow delete (api)];
``

Run the following command : 

```bash
curl -XPUT -H "Content-Type: application/json" http://localhost:9200/_all/_settings -d '{"index.blocks.read_only_allow_delete": null}'
```

#### BattleNet Endpoint Models :

**Achievement**

| Model       | Endpoint                                              | Type             |
| ----        | ----------                                            | ----------       |
| ----        | _Character_                                           | ----------       |
| Achievement | /characters/{username}/{realm}/achievements/completed | GET (collection) | 
| Achievement | /characters/{username}/{realm}/achievements           | GET (collection) | 
| Character   | /characters/{username}?realm={realm}                  | GET (item)       |
| Feed        | /characters/{username}/{realm}/feeds                  | GET (collection) |
| Guild       | /characters/{username}/{realm}/guild                  | GET (item)       |
| Items       | /characters/{username}/{realm}/items                  | GET (item)       |
| Mount       | /characters/{username}/{realm}/mounts                 | GET (item)       |
| Pets        | /characters/{username}/{realm}/pets                   | GET (item)       |
| Reputation  | /characters/{username}/{realm}/reputations            | GET (collection) |
| Stats       | /characters/{username}/{realm}/stats                  | GET (item)       |
| ----        | _Others_                                              | ----------       |
| Classes     | /classes                                              | GET (collection) |
| Mounts      | /mounts                                               | GET (collection) |
| Race        | /races                                                | GET (collection) |
| Realm       | /realms/{realm}                                       | GET (item)       |
| Realm       | /realms                                               | GET (collection) |
