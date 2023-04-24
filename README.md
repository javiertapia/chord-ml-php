# chords-ml-php

Este es un intérprete de unas reglas de marcado simples que permiten graficar acordes. Está escrito en PHP. Dentro de cada clase se menciona su alcance y funcionalidad.

---

This is an interpreter for a simple markup rules for graphing chords, written in PHP. Each class includes a description about his scope and functionality.


## Objetivo | Goals

Dibujar el diagrama de un acorde de un instrumento de cuerda a partir de un marcado simple que indique el nombre del acorde y la posición de los dedos en cada cuerda. Si la postura del acorde exige usar un dedo como cejilla, este se intuye a partir del diagrama. No hay un mínimo o máximo en la cantidad de cuerdas a representar.

Estos son algunos marcados y sus representaciones para instrumentos de seis, cinco y cuatro cuerdas:

---

Draw a chord diagram for a string instrument from a simple markup indicating the name of the chord and the position of the fingers on each string. If the chord posture calls for using one finger as a capo, this is inferred from the diagram. There is no minimum or maximum on the number of strings to represent.

Here are some markings and their representations for six, five, and four-string instruments:

```
Guitarra:
DO:   0-3-2-0-1-0
lad7: x-0-5-5-4-3
FA#7: 2-4-2-3-5-2

Charango:
SOL: 0-2-3-2-3

Cuatro venezolano:
MI: 2-2-2-0

DO        lad7      FA#7      SOL      MI
||||o|    |||||o 3  ====== 2  |||||    |||| 
||o|||    ||||o|    |||o||    |o|o|    ooo|
|o||||    ||oo||    |o||||    ||o|o    ||||
          x         ||||o|
```

## Reglas del marcado | Markup rules

* El nombre del acorde y la posición de los dedos en las cuerdas deben ser una misma línea de texto.
* El nombre del acorde y la posición de los dedos deben estar separados por dos puntos `:`.
* La posición de los dedos van ordenados desde la cuerda que está más arriba en el instrumento, es decir, la primera cuerda es la última que se indica.
* En la posición de los dedos, las cuerdas se separan con un guion `-`.
* La posición de los dedos debe ser un número que indica el espacio presionado en el instrumento. Si la cuerda está "al aire" (no presionado) debe indicarse un cero `0` y, si la cuerda no se debe tocar, debe indicarse una equis `x`.

---

* The chord name and the position of the fingers on the strings must be on the same line of text.
* Chord name and finger position must be separated by colons `:`.
* The position of the fingers is ordered from the string that is highest on the instrument, that is, the first string is the last one indicated.
* In finger position, the strings are separated by a hyphen `-`.
* The position of the fingers should be a number that indicates the space pressed on the instrument. If the string is "open" (not pressed) a zero `0` should be indicated and, if the string should not be played, an X `x` should be indicated.


## Requerimientos

Usé **PHP 8.2** para conocer y usar algunas de las características nuevas del lenguaje. Por la sencillez de la implementación, no debería ser complejo reescribirlo para una versión anterior.

No existen otras dependencias, pero incluí un `composer.json` con algunas dependencias **solo para desarrollo**. Para instalarlas, se debe ejecutar `composer install` desde la línea de comandos del directorio del proyecto.

---

I used **PHP 8.2** to learn and use some of the new features of the language. Due to the simplicity of the implementation, it should not be difficult to rewrite it for a previous version.

There are no other dependencies, but I included a `composer.json` with some dependencies **for development only**. To install them, run `composer install` from the project directory command line.

## Tests

Incluí un conjunto de tests de **phpunit** en el directorio `test`. Además, sometí al código fuente al análisis estático de **phpstan**. Para ejecutarlas, se debe introducir lo siguiente desde la línea de comandos:

---

I included a set of **phpunit** tests in the `test` directory. In addition, I subjected the source code to **phpstan** static analysis. To execute them, the following commands must be entered from the command line:

```bash
# Ubicarse en el directorio del proyecto | Locate into the project directory
cd <chords-ml-dir>
# Instalar las dependencias | Install dependencies
composer install
# Ejecutar los tests de phpunit | Run phpunit tests
./vendor/bin/
# Ejecutar los análisis de phpstan | Run phpstan analysis
./vendor/bin/phpstan --level=7 analyse ./src --configuration=./phpstan.neon
```

## Ejemplos 

Incluí un ejemplo en el directorio `examples`. Se puede ejecutar por línea de comandos, ingresando `php ./examples/index.php` desde el directorio del proyecto. O bien, iniciando el servidor web integrado de PHP con el comando `php -S localhost:8000 -t examples/` y luego accediendo con el navegador web a la dirección http://localhost:8000.

---

I have included an example in the `examples` directory. It can be run from the command line, by entering `php ./examples/index.php` from the project directory. Or, by starting the built-in PHP web server with the command `php -S localhost:8000 -t examples/` and then accessing the web browser to the address http://localhost:8000.

## TODO

* [ ] Salida en formato HTML, para decorar con CSS.  
HTML output, for CSS styling.
* [ ] Salida en formato SVG, para usar en una página web.  
SVG output, to embed into a web page.
* [ ] Descargar o guardar en disco el SVG generado.  
Download SVG output into a file.
