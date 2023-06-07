# cotxenet.net_FW_PHP_OO_MVC_JQUERY
# README

Esta es una aplicación web de venta de vehículos online desarrollada con:
<p align="center">
  <a href="https://skillicons.dev">
    <img src="https://skillicons.dev/icons?i=bootstrap,css,html,js,php,github" />
  </a>
 <a   <div style="display: flex; align-items: flex-start;"><img src="https://techstack-generator.vercel.app/mysql-icon.svg" alt="icon" width="50" height="50" /></div></a>
</p>
La aplicación sigue una arquitectura <strong>Modelo-Vista-Controlador (MVC)</strong> y utiliza el <strong>framework jQuery</strong>. También se ha implementado el uso de JSON Web <strong>Tokens (JWT)</strong> para la creación de tokens de autenticación, así como la integración de <strong>Mailgun</strong> para el envío de correos electrónicos de <strong>verificación de cuenta y recuperación de contraseña.</strong>

## Características principales

La aplicación cuenta con los siguientes módulos:

<h3><strong>1. Home:</strong></h3>
 Muestra la página principal de la aplicación, proporcionando información general sobre la plataforma de venta de vehículos online. Donde podemos <strong>filtrar</strong> por marca con <strong>carrusel</strong>, categoria, tipo de combustible y también se muestran los mas visitados. Tenemos una selección de revistas relacionadas con el mundo del motor con <strong>scroll</strong>, mediante una <strong>api</strong> donde se enlaza para su compra.

<h3><strong>2. Shop:</strong></h3>
 Permite a los usuarios explorar y buscar vehículos disponibles para la venta. Los usuarios pueden aplicar <strong>filtros</strong> y ver detalles específicos de cada vehículo, como descripción, características, precio, etc. Posee <strong>paginado</strong> para mostrar los resultados de la busqueda o de todos los vehículos Tenemos una <strong>geolocalización</strong> donde se encuentran los vehículos y una pequeña descripcion e imagen en el mapa, donde podemos ir a ver los detalles de los mismos. Tambien nos encontramos un <strong>search</strong> en el menu de la página, donde automaticamente se autocompleta por marca, categoria o ciudad, al seleccionar uno de los de busqueda. Se le pueden asignar <strong>likes</strong> a los productos, logeado y deslogueado, si estas deslogueado te redirige a login para loguearte y enviate al vehiculo en cuestion. En este módulo cuando se selecciona un coche para ver en detalle la información, mostramos también vehículos relacionados en este caso por marca con <strong>scroll</strong>.

<h3><strong>3. Contacto:</strong></h3> 
Proporciona un formulario de contacto donde los usuarios pueden enviar consultas o comentarios sobre la aplicación o los vehículos en venta.

<h3><strong>4. Login y Register:</strong></h3>
Estos módulos permiten a los usuarios crear una cuenta o iniciar sesión en la aplicación. Se utiliza <strong>JWT</strong> para autenticar a los usuarios y proporcionar acceso seguro a las funcionalidades. Posee <strong>verificación</strong> por correo electrónico y <strong>recuperación</strong> de contraseña. 

<h3>5. Carrito:</h3> Permite a los usuarios agregar vehículos de interés a su carrito de compras y realizar la <strong>compra</strong> posteriormente.

## Requisitos previos

- PHP 7.0 o versiones superiores.
- Servidor web compatible con PHP ( Apache).
- Base de datos MySQL para almacenar la información de los vehículos y los datos de los usuarios.
