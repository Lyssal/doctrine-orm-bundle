# The entity manager

You can use the Lyssal Doctrine ORM manager as the base of all your entity managers.


## Use

```php
use Lyssal\Doctrine\Orm\Manager\EntityManager;

/**
 * The MyEntity's manager.
 */
class MyEntityManager extends EntityManager
{
    // Your logic
}
```

You also can directly use the Lyssal Doctrine ORM manager, just use the parameter `lyssal.doctrine.orm.entity_manager.class`.

```xml
<service id="acme.my_bundle.manager.my_entity" class="%lyssal.doctrine.orm.entity_manager.class%">
    <argument type="service" id="doctrine.orm.entity_manager" />
    <argument>Acme/MyBundle/Entity/MyEntity</argument>
</service>
```


## The method parameters

Read the API documentation for the list of the methods.

### The `$conditions` parameter

The Lyssal Doctrine ORM library extends this parameter.

For example:

```php
use Lyssal\Doctrine\Orm\QueryBuilder;

// (gender = $gender OR genderParent = $gender) AND gender.name LIKE '%trategi%'
$conditions = [
    QueryBuilder::OR_WHERE => [
        'gender' => $gender,
        'genderParent' => $gender
    ],
    QueryBuilder::WHERE_LIKE => [
        'gender.name' => '%trategi%'
    ]
];

// (gender.name LIKE '%trategi%' OR gender.name LIKE '%éflexio%')
$conditions = [
    QueryBuilder::OR_WHERE => [
        [QueryBuilder::WHERE_LIKE => array('gender.name' => '%trategi%')],
        [QueryBuilder::WHERE_LIKE => array('gender.name' => '%éflexio%')]
    ]
];
```

Possibilities for the `$conditions` parameter are:

* `QueryBuilder::OR_WHERE` : x OR y OR ...
* `QueryBuilder::AND_WHERE` : x AND y AND ...
* `QueryBuilder::WHERE_LIKE` : x LIKE y
* `QueryBuilder::WHERE_IN` : x IN (y1, y2...)
* `QueryBuilder::WHERE_NULL` : x IS NULL
* `QueryBuilder::WHERE_NOT_NULL` : x IS NOT NULL
* `QueryBuilder::WHERE_EQUAL` : x = y
* `QueryBuilder::WHERE_LESS` : x < y
* `QueryBuilder::WHERE_LESS_OR_EQUAL` : x <= y
* `QueryBuilder::WHERE_GREATER` : x > y
* `QueryBuilder::WHERE_GREATER_OR_EQUAL` : x >= y

and for HAVING:

* `QueryBuilder::OR_HAVING`
* `QueryBuilder::AND_HAVING`
* `QueryBuilder::HAVING_EQUAL`
* `QueryBuilder::HAVING_LESS`
* `QueryBuilder::HAVING_LESS_OR_EQUAL`
* `QueryBuilder::HAVING_GREATER`
* `QueryBuilder::HAVING_GREATER_OR_EQUAL`


### The `$extras` parameter

The Lyssal Doctrine library adds this new parameter.

For example:

```php
$extras = [
    // innerJoin('city.country', 'country')
    QueryBuilder::INNER_JOINS => [
        'city.country' => 'country'
    ],
    // addSelect('country')
    QueryBuilder::SELECTS => [
        'country' => QueryBuilder::SELECT_JOIN
    ]
];
```

Possibilities for the `$extras` parameter are:

* `QueryBuilder::SELECTS` : Calls the `addSelect()` method. You can add a joined entity or any other value (an entity property, a COUNT, etc).
* `QueryBuilder::LEFT_JOINS`
* `QueryBuilder::INNER_JOINS`
* `QueryBuilder::GROUP_BYS`
