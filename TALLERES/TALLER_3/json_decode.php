<?php
// Ejemplo de uso de json_decode() con un JSON simple
$jsonFrutas = '["manzana","banana","naranja"]';
$frutas = json_decode($jsonFrutas);
echo "<br><br>JSON de frutas decodificado:";
print_r($frutas);

// Ejemplo con un JSON de objeto
$jsonPersona = '{"nombre":"Juan","edad":30,"ciudad":"Madrid"}';
$persona = json_decode($jsonPersona, true); // true para obtener un array asociativo
echo "<br><br>JSON de persona decodificado como array:";
print_r($persona);

// Ejercicio: Decodifica el JSON de tu película favorita del ejercicio anterior
$jsonPelicula = '{"titulo":"El origen","director":"Christopher Nolan","año":2011,"actores":["Actor 1","Actor 2","Actor 3"]}';
$peliculaFavorita = json_decode($jsonPelicula, true);
echo "<br><br>Información de tu película favorita decodificada:";
print_r($peliculaFavorita);

// Bonus: Trabajar con JSON anidado
$jsonComplejo = '{
    "nombre": "María",
    "edad": 28,
    "hobbies": ["leer", "nadar", "viajar"],
    "direccion": {
        "calle": "Calle Principal",
        "numero": 123,
        "ciudad": "Barcelona"
    }
}';
$datosComplejos = json_decode($jsonComplejo, true);
echo "<br><br>JSON complejo decodificado:";
print_r($datosComplejos);

// Extra: Manejo de errores en json_decode()
$jsonInvalido = '{"nombre": "Pedro", "edad": 35,}'; // JSON inválido (coma extra)
$resultado = json_decode($jsonInvalido);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "<br><br>Error al decodificar JSON: " . json_last_error_msg();}
?>
      
