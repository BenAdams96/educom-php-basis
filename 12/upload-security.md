Bij het uploaden controleren of de upload goed is gegaan, of het bestand kleiner is dan 1 MB en of de extensie jpg, jpeg of png is. Als de bestandsnaam al bestaat krijgt het bestand een unieke naam met uniqid(). In productie bijvoorbeeld 'bin2hex(random_bytes(16))' gebruiken, die geeft sterkere en minder voorspelbare naam.

Niet alleen op de extensie checken, omdat iemand een verkeerd bestand gewoon '.jpg' kan noemen. Daarom ook controleren of het bestand echt een afbeelding is, bijvoorbeeld met 'getimagesize()' of het mime-type (geeft bv: image/jpeg)

Verder alleen toegestane bestandstypes accepteren en bestanden altijd onder een zelf gegenereerde unieke naam opslaan.