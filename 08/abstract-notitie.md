# Les 08

## abstract class

Voornaamste reden waarom abstract class niet als class gebruikt kan worden is omdat het meer fungeert als initieel blauwprint. je erft de basis code. je kunt er niet direct een class van bouwen door 'new' te gebruiken.

Een abstracte class mag gewone variabelen en methodes bevatten. Deze methodes mogen ook al volledig uitgewerkt zijn. Daarnaast kan een abstracte class abstracte methodes bevatten. Deze hebben nog geen inhoud en moeten door een child class worden ingevuld.

in de code/voorbeeld heeft Vehicle de abstracte methode drive(). Daarom moet Car zelf bepalen wat drive() doet.

dit werkt dus niet: $vehicle = new Vehicle();
dit werkt dus wel: $car = new Car();

