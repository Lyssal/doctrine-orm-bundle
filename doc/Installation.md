# Installation


* Install with Composer:

```sh
composer require lyssal/doctrine-orm-bundle
```

* If you use your own administrators, tag them:

```yaml
services:
    _instanceof:
        Lyssal\Doctrine\Orm\Administrator\EntityAdministratorInterface:
            tags: ['lyssal.entity_administrator']
```
