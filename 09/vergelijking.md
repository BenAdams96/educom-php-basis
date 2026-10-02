# Cookie vs session

Bij een cookie word informatie opgeslagen in de browser van de gebruiker.

Bij een session word de informatie meer aan de server kant bijgehouden. De browser krijgt alleen een session id mee.

Voor inloggen is een session daarom handiger en veiliger. Je hoeft dan niet de login informatie zelf in een cookie op te slaan.

Bij login kan je bijvoorbeeld de gebruiker opslaan met:

```php
$_SESSION["user"] = $user;
```

En bij uitloggen kan je de session verwijderen met:

```php
session_destroy();
```