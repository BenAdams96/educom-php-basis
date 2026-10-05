# SQL injection

SQL injection kan gebeuren als input van een gebruiker direct in een SQL query word gezet.
Hiermee kan de originele query aangepast worden, waardoor bijvoorbeeld altijd ingelogd kan worden.

Bijvoorbeeld:

```php
$name = $_GET["name"];

$sql = "SELECT * FROM personen WHERE naam = '$name'";
```

Je verwacht normaalgesproken dat iemand zijn naam invult, maar als je hier its invult als:'" OR 1==1'
dan ziet de code dit als een lege naam maar ook als een OR statement. hierdoor kan de WHERE wegvallen.

omdat het is: WHERE naam = '' OR 1==1
en dan blijft over: SELECT * FROM personen
oftewel alle infor over alle gebruikers.

Met een prepared statement word de query en de input apart gehouden.
```php
$sth = $dbh->prepare(
    "SELECT * FROM personen WHERE naam = :naam"
);

$sth->execute([
    "naam" => $name
]);
```

:naam is hier een placeholder. en wat ingevoerd word, kan niet direct de QUERY beinvloeden.