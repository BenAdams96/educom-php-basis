# MVC spraakverwarring
MVC kan voor spraakverwarring zorgen omdat niet iedereen precies hetzelfde bedoelt met Model, View en Controller.

In mijn eigen opdracht haalt de controller de data op via het model en laadt daarna de view. Maar in een framework doet de controller meer: daar handelt hij ook requests af en bepaalt hij welke pagina teruggestuurd wordt.

Het verschilt ook per soort applicatie. Bij een webapp werkt MVC anders dan bij een desktopapplicatie. Dus de ene zegt "dat hoort in het Model" en de ander denkt daar iets anders bij.

# hoe te voorkomen?
door in project af te spreken wat Model, View en Controller betekenen. Bijvoorbeeld: database en code ervan staat in het Model, de View bevat alleen HTML, en validatie doet de Controller.