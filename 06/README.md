# Les 06

Voor de database-opdracht heb ik een database `webshop` gemaakt met drie tabellen.

## user

- `id` - INT, primary key, auto increment
- `naam` - VARCHAR
- `wachtwoord` - VARCHAR

Hierin staan de gebruikers die kunnen inloggen.

## items

- `id` - INT, primary key, auto increment
- `naam` - VARCHAR
- `prijs` - DECIMAL

Hierin staan de producten die in de webshop worden getoond.

## orders

- `id` - INT, primary key, auto increment
- `user_id` - INT
- `item_id` - INT

Wanneer een gebruiker op "Voeg toe" klikt, wordt er een nieuwe regel toegevoegd aan deze tabel met de gebruiker en het gekozen item.

De ingelogde gebruiker wordt opgeslagen in een session.