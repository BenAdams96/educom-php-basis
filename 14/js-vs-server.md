JavaScript-validatie is handig omdat je dan direct feedback krijgt zonder dat het formulier eerst naar de server gestuurd hoeft te worden.

denk aan:
- lege velden controleren
- postcode controleren
- telefoonnummer controleren
- e-mail controleren

Javascript draait aan de client kan, en dus alleen de browser van de gebruiker. die kan dingen aanpassen (bv met devtools). Ook word de gebruiker al geguide naar de juiste input zonder request naar de server te sturen.
De extra controle aan de server kant zal altijd nodig blijven omdat de gebruiker dus via bv de devtools de controles aan de client kant uitschakelen/aanpassen. Op de server is dat niet mogelijk.