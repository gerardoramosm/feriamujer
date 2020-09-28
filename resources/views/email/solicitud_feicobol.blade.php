<html>
<head>
<title></title>    
</head>
<body>
Este es un mensaje programado por el Sistema de Administración de Ferias de FEICOBOL.<br><br>
Se genero una nueva solicitud de participación para la REACTIVA BOLIVIA 2020, se le recomienda leer la misma.<br><br>
El detalle de la solicitud es la siguiente:<br><br>
<ul>
    <li><strong>Empresa:</strong>{{$data['nombre_empresa']}}</li>
    <li><strong>NIT:</strong>{{$data['nit']}}</li>
    <li><strong>Nombre de la persona de contacto:</strong>{{$data['nombre_responsable']}}</li>
    <li><strong>Telefono de contacto:</strong>{{$data['telefono']}}</li>
    <li><strong>Correo Electronico:</strong>{{$data['email']}}</li>
    <li><strong>Cantidad de stands:</strong>{{$data['cantidad']}}</li>
    <li><strong>Detalle de stands:</strong>
        @for($i=0;$i<$data['cantidad'];$i++)
        <ul>
            <li><strong>Nombre de Stand:</strong>{{$data['nombre_stand'][$i]}}</li>
            <li><strong>Productos del Stand:</strong>{{$data['productos'][$i]}}</li>
        </ul>
        @endfor
    </li>
</ul>
<br><br>Para revisar el listado de pendientes de aprobación ingrese al siguiente link: <a href="http://sistema.feicobol.com.bo/virtual/pendientes/4" target="_blank">http://sistema.feicobol.com.bo/virtual/pendientes/4</a><br><br>
NOTA: El presente mensaje no requiere respuesta, es solo con motivo de informacion.
</body>
</html>