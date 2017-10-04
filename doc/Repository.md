# The entity repository

See the [Lyssal Doctrine ORM manager documentation](Manager.md) for more informations about the method parameters.


## Use

### By default

```yml
doctrine:
    orm:
        default_repository_class: 'Lyssal\Doctrine\Orm\Repository\EntityRepository'
```

### Extends

Vous devez simplement étendre votre repository :

```php
namespace Acme\MyBundle\Repository;

use Lyssal\Doctrine\OrmBundle\Repository\EntityRepository;

/**
 * My repository.
 */
class MyEntityRepository extends EntityRepository
{
    // My specific methods
}
```

```php
namespace Acme\MyBundle\Entity;

use Doctrine\ORM\Mapping as Orm;

/**
 * My entity.
 * 
 * @Orm\Entity(repositoryClass="\Acme\MyBundle\Repository\MyEntityRepository")
 * @Orm\Table()
 */
class MyEntity
{
    //...
}
```
