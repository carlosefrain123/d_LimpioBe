@component('mail::message')
# ¡Bienvenido a Limpio Be, {{ $name }}! 🧼✨

Gracias por unirte a nuestra comunidad. En nuestra tienda encontrarás productos de limpieza de alta calidad, pensados para mantener tus espacios siempre impecables.

@component('mail::button', ['url' => url('/')])
Explorar Productos
@endcomponent

Si tienes alguna consulta, estamos aquí para ayudarte.

Saludos cordiales,<br>
**El equipo de Limpio Be**
@endcomponent
