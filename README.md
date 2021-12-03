## Ejemplo de aplicación de TDD sobre Laravel

###Requerimientos

Modelar los objetos necesarios para poder guardar las puntuaciones de los partidos de voleibol con la finalidad de mediante TDD ir construyendo la implementación de dichos objetos.

- El número de sets de un partido estará entre 3 y 5.
- Si un equipo gana los 3 primeros sets no se jugará más.
- Si un equipo ganara 3 de los 4 primeros sets no se jugará más.
- Los sets del 1 al 4 ganará quien tenga una puntuación de N + 2 siendo N la puntuación del rival considerando la puntuación mínima 25.
- El 5 set ganará quien tenga una puntuación de N + 2 siendo N la puntuación del rival considerando la puntuación mínima 15.

