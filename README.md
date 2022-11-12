## API REST para un showroom de indumentaria
- Para su funcionamiento importar la BASE DE DATOS: database/db_showroom.php
- Para usarla en postman http://localhost/web2/tpe2API/api/cliente
- Ejemplos de uso:
[GET] .../api/cliente (accede a un listado de todos los clientes)
[GET] .../api/cliente/2 (accede al cliente con id 2)
[POST] .../api/cliente (lee el contenido del body y agrega un nuevo cliente)
[PUT] .../api/cliente/5 (lee el contenido del body y edita los datos del cliente seleccionado)
[DELETE] .../api/cliente/7 (borra al cliente con el id 7)

- Para hacer un POST o un PUT se deben ingresar los datos con el siguiente formato:
{
    "nombre": "Arispe",
    "apellido": "Florencia",
    "dni": "38824535",
    "email": "florenciaarispe98@gmail.com"
}

- Otras herramientas:
    - Ascendentemente: .../api/cliente?sort=nombre&order=asc (Ordena los nombres ascendentemente)
    - Descendentemente: .../api/cliente?sort=apellido&order=desc (Ordena los apellidos descendentemente)
    - Filtro: .../api/cliente?filtername=florencia (Muestra solo las columnas que tengan el nombre florencia)
    - Paginacion:.../api/cliente?page=2&limit=1 (Muestra 1 elemento (limit) de la pagina 2 (page))

