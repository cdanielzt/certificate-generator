@component('mail::message')
# Reconocimiento

Te hacemos entrega de tu reconocimiento por asistir al 4° Foro Emprendedor Tapachula

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Gracias, el equipo.<br>
{{ config('app.name') }}
@endcomponent
