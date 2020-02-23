# The entity repository

See the [Lyssal Doctrine ORM administrator documentation](Administrator.md) for more informations about the method parameters.


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
namespace App\Doctrine\Repository;

use Lyssal\Doctrine\Orm\Repository\EntityRepository;

/**
 * The MyEntity repository.
 */
final class MyEntityRepository extends EntityRepository
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
 * @Orm\Entity(repositoryClass="\App\Doctrine\Repository\MyEntityRepository")
 */
final class MyEntity
{
    //...
}
```
