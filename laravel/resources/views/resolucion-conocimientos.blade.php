@extends('base.app')

@section('title', 'Inicio')

@section('content')
<div class="container py-4">
  <div class="text-center mb-5">
    <h2 class="fw-bold mb-3">Resolución de preguntas</h2>
    <center>
      <img src="https://sinergiaonline.com/wp-content/uploads/2025/03/logo-color-sinergia@2x.png" alt="">
    </center>
    <p>Aqui encontraras la respuesta a las preguntas realizadas en el custionario de prueba tecnica.</p>
  </div>

  <h1>A.	¿Qué es una variable?</h1>
  <p>Una variable es lo que normalmente llamamos almacenar un valor que puede ser una constante o puede cambiar dependiendo de como se interactue o implemente, de acuerdo a ello, una variable
    es poder almacenar un valor dentro de nuestro programa para poder usarlo mas adelante o ser llamado por el mismo programa.
  </p>
  <code>
    $variable = "Hola Mundo";
    
    //Esta variable lo que hace es almacenar en la memoria de nuestro programa el valor "Hola Mundo" para poder ser llamado mas adelante.
  </code>
  <hr>

  <h1>B.	¿Qué es un ciclo?, ¿mencione dos tipos de ciclos que conozca?</h1>
  <p>Un ciclo es iterar algo hasta llegar a un punto final es decir supongamos que mi programa debe realizar una cierta acción como imprimir en pantalla los numeros del 1 al 10 de acuerdo a ello mi programa necesita iterar y contar cada impresión hasta llegar al 10,
    Asi funcionan los ciclos otro ejemplo seria recorrer una tabla de una base de datos en este caso el ciclo se encargaria de recorrer cada fila de la tabla hasta llegar al final de la misma.
    Estos ciclos en la programación son muy usados y existen varios tipos de ciclos, que pueden variar dependiendo del lenguaje de programación, pero los mas comunes son:
    <ul>
      <li>Ciclo For: Este ciclo se usa cuando sabemos de antemano cuantas veces se debe iterar, por ejemplo recorrer un array o una lista.</li>
      <li>Ciclo While: Este ciclo se usa cuando no sabemos de antemano cuantas veces se debe iterar, este ciclo se ejecuta mientras una condición sea verdadera.</li>
    </ul>
    <br>
    <code>
        //Ejemplo de ciclo For
        for ($i = 1; $i <= 10; $i++) {
            echo $i;
        }
    
        //Ejemplo de ciclo While
        $i = 1;
        while ($i <= 10) {
            echo $i;
            $i++;
        }

    </code>
  </p>
  <hr>


  <h1>C.	¿Qué es un condicional?</h1>
  <p>Una condicional es lo que normalmente llamamos depender de algo para poder ejecutar otra cosa o acción es decir, si lo ponemos en un ejemplo de la vida real, para yo poder hacer cafe necesito comprar cafe para poder hacerlo
    si no tengo cafe no podre hacerlo, de acuerdo a ello en la programación las condicionales son usadas para evaluar si una condición es verdadera o falsa y dependiendo de ello ejecutar una acción u otra.
    Al igual que con los ciclos la escritura de las condicionales puede variar dependiendo del lenguaje de programación, pero los mas comunes son:
    <ul>
        <li>If: Esta condicional se usa para evaluar si una condición es verdadera o falsa, si es verdadera se ejecuta una acción, si es falsa se puede ejecutar otra acción o no hacer nada.</li>
        <li>Switch: Esta condicional se usa para evaluar una variable y dependiendo de su valor ejecutar una acción u otra.</li>
    </ul>
    <br>
    <code>
        //Ejemplo de condicional If
        $edad = 18;
        if ($edad >= 18) {
            echo "Eres mayor de edad";
        } else {
            echo "Eres menor de edad";
        }
    
        //Ejemplo de condicional Switch
        $dia = "Lunes";
        switch ($dia) {
            case "Lunes":
                echo "Hoy es Lunes";
                break;
            case "Martes":
                echo "Hoy es Martes";
                break;
            default:
                echo "No es Lunes ni Martes";
                break;
        }
    </code>
  </p>
  <hr>
  <h1>D.	En el caso de un estudiante, cuando mencionamos su nombre, edad, sexo, dirección y teléfono, estamos mencionando: 
    <br>
a.	Los atributos de una clase
<br>b.	Las operaciones de una clase
<br>c.	Los objetos de una clase
<br>d.	Ninguna de las anteriores
</h1>
<p>La respuesta serian los atributos de acuerdo a que hacen parte de una funcion o objeto del estudiante, por ello lo que contiene este según el caso mencionado son sus datos personales.</p>
<code>
    class Estudiante {
        //Atributos
        public $nombre;
        public $edad;
        public $sexo;
        public $direccion;
        public $telefono;

        //Operaciones
        public function estudiar() {
            echo "El estudiante esta estudiando";
        }

        public function descansar() {
            echo "El estudiante esta descansando";
        }
    }
</code>
  <hr>
  <h1>E.	¿Qué es la programación Orientada a Objetos (POO)?</h1>
  <p>
    La programación orientada a objetos (PDO) es el uso de encapsular datos y funciones en una sola entidad llamada objeto, de acuerdo a ello la POO se basa en poder contener un objeto o varios objetos que contienen datos y funciones que pueden ser usadas para interactuar con dichos datos.
    <br>
    La POO se basa en varios conceptos como:
    <ul>    
        <li>Clases: Son plantillas o moldes que definen las propiedades y comportamientos de un objeto.</li>
        <li>Objetos: Son instancias de una clase, es decir, son la representación concreta de una clase.</li>
        <li>Atributos: Son las propiedades o características de un objeto.</li>
        <li>Métodos: Son las funciones o acciones que un objeto puede realizar.</li>
        <li>Herencia: Es la capacidad de una clase de heredar las propiedades y métodos de otra clase.</li>
        <li>Polimorfismo: Es la capacidad de un objeto de tomar diferentes formas o comportamientos dependiendo del contexto en el que se use.</li>
        <li>Encapsulamiento: Es la capacidad de ocultar los detalles internos de un objeto y exponer solo lo necesario para interactuar con él.</li>
    </ul>
    <br>
    <code>
        class Persona {
            //Atributos
            public $nombre;
            public $edad;

            //Métodos
            public function saludar() {
                echo "Hola, mi nombre es " . $this->nombre;
            }
        }

        class Estudiante extends Persona {
            //Atributos
            public $curso;

            //Métodos
            public function estudiar() {
                echo "Estoy estudiando " . $this->curso;
            }
        }

        $estudiante = new Estudiante();
        $estudiante->nombre = "Alejandro";
        $estudiante->edad = 23;
        $estudiante->curso = "Ciencia";
        $estudiante->saludar(); // Hola, mi nombre es Alejandro
        $estudiante->estudiar(); // Estoy estudiando Ciencias
    </code>
  </p>
  <hr>
  <h1>F.	¿Que son patrones de diseño y para que se pueden utilizar?</h1>
  <p>Los patrones de diseño son guias a nivel mundial que logran dar un indice de como se debe comportar un codigo, algoritmo o programa, su estructuración, codificación o escritura, esto para definir reglas en lo que se desarrola,
    para el facil entendimiento de otros desarrolladores, de acuerdo a ello los patrones de diseño son usados para resolver problemas comunes en el desarrollo de software, estos patrones pueden ser clasificados en tres categorias:
    <ul>
        <li>Patrones Creacionales: Estos patrones se encargan de la creación de objetos, estos patrones son usados para abstraer el proceso de creación de objetos y hacer que el sistema sea independiente de la forma en que los objetos son creados, compuestos y representados. Ejemplos: Singleton, Factory Method, Abstract Factory.</li>
        <li>Patrones Estructurales: Estos patrones se encargan de la composición de clases y objetos, estos patrones son usados para facilitar la estructura y organización del código, haciendo que sea más fácil de entender y mantener. Ejemplos: Adapter, Composite, Decorator.</li>
        <li>Patrones de Comportamiento: Estos patrones se encargan de la interacción entre objetos, estos patrones son usados para definir cómo los objetos interactúan entre sí y cómo se comunican. Ejemplos: Observer, Strategy, Command.</li>
    </ul>
    <br>
    <code>
        //Ejemplo de patrón Singleton
        class Singleton {
            private static $instance;

            private function __construct() {
                // Constructor privado para evitar la creación de instancias desde fuera de la clase
            }

            public static function getInstance() {
                if (self::$instance === null) {
                    self::$instance = new Singleton();
                }
                return self::$instance;
            }
        }

        $singleton1 = Singleton::getInstance();
        $singleton2 = Singleton::getInstance();

        // Ambos objetos son la misma instancia
        var_dump($singleton1 === $singleton2); // true

        //En este ejemplo basicamente tenemos un patrón de diseño donde podemos ver que la clase Singleton tiene un constructor privado para evitar que se creen instancias desde fuera de la clase, y un método estático getInstance() que se encarga de crear una única instancia de la clase y devolverla cada vez que se llama a este método.
    </code>
  </p>
  <hr>
  <h1>G.	¿Cuál operador condicional de PHP evalúa que los valores son iguales y del mismo tipo de datos? (5%)
<br>o	==
<br>o	||
<br>o	===
<br>o	==?
</h1>
<p>El operador que valida la igualidad completa de una condicional en este caso para PHP es ===</p>
<code>
    $a = 5; // entero
    $b = '5'; // cadena

    var_dump($a == $b);  // true, porque solo compara el valor
    var_dump($a === $b); // false, porque compara el valor y el tipo de dato
</code>
<hr>

<h1>
H.	Desde un punto de vista Booleano, cada valor de cero o string vacío en PHP se considera: (5%) 
<br>o	True 
<br>o	False 
<br>o	Error 
<br>o	Null
</h1>

<p>
    La respuesta correcta es False, ya que en PHP, los valores de cero (0) y las cadenas vacías ("") se consideran como valores falsos (False) en un contexto booleano.
</p>
<code>
    $valor1 = 0; // entero cero
    $valor2 = ""; // cadena vacía

    if (!$valor1) {
        echo "El valor1 es considerado False cuando se habla de booleano.\n"; 
    }

    if (!$valor2) {
        echo "El valor2 es considerado False cuando se habla de booleano.\n"; // Esto se imprimirá
    }

</code>

<hr>
<h1>I.	De la siguiente estructura escriba el resultado final de la variable $c: </h1>
<code>
    $a = 1;
    $b = 9; 

    for ( $i = $a; $i <= $b; $i = $i+1){ 
    $c = $a + $i; 
    }
    echo $c;

</code>


<p>El resultado final de la variable $c es 10, ya que el ciclo for itera desde el valor de $a (1) hasta el valor de $b (9), incrementando $i en 1 en cada iteración. En cada iteración, la variable $c se actualiza con la suma de $a y el valor actual de $i. 
    Por lo tanto, en la última iteración cuando $i es igual a 9, $c se calcula como 1 + 9, lo que da como resultado 10.
</p>
<hr>
<h1>J.	De la siguiente estructura escriba el resultado final de la variable $c: </h1>
<code>
    $b = 1;
    $c = 0;
    while $b < 11 { 
    $c = $c + 1; 
    $b=$b + 1; 
    } 
    echo $c;

</code>



<p>El resultado final de la variable $c es 10, ya que el ciclo while itera mientras la variable $b sea menor que 11. En cada iteración, la variable $c se incrementa en 1 y la variable $b también se incrementa en 1. 
    El ciclo comienza con $b igual a 1 y termina cuando $b alcanza el valor de 11. Por lo tanto, el ciclo se ejecuta 10 veces, lo que hace que $c sea igual a 10 al final del ciclo.
</p>
<hr>

<h1>K.	De la siguiente estructura escriba el resultado final de la variable $print: </h1>
<code> 
$a=5; 
$b=6; 
$x=8; 
$c=20; 
$print=””;

if ($a <= $b and $b >= $c){ 
if ($x <= $c and $c >= 10){ 
$print=”Feliz Navidad”;
 } 
}else{ 
if ($c > $x or $x <= $b){ 
$print=”Feliz Año”; 
} 
} 
echo $print;
    
</code>



<p>El resultado es "Feliz Año"   de acuerdo a que la primera condicional no se cumple y dentro del else la condicional si cumple para $c > $x.</p>


</div>

@endsection
