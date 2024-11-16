Explicación del código
Formulario HTML:

Usa el método POST para enviar los datos al archivo register.php.
Contiene los campos nombre, email y password.
Conexión a la base de datos:

Conectamos PHP con MySQL usando mysqli.
Verificamos la conexión con connect_error.
Inserción directa en la base de datos:

Obtenemos los datos usando $_POST.
Creamos una consulta SQL directamente usando los valores obtenidos del formulario.
Usamos $conn->query() para ejecutar la consulta.
