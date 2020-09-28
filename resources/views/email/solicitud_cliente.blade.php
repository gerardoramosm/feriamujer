<html>
<head>
<title></title>    
</head>
<body>
Este es un mensaje programado por el Sistema de Administración de Ferias de FEICOBOL.<br><br>
Se recibió correctamente su solicitud de participación para la REACTIVA BOLIVIA 2020.<br><br>
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
<br><br>Un responsable del Departamento Comercial de FEICOBOL lo contactará para los siguientes pasos del registro.<br>
En caso de consultas o dudas, puede llamar a los siguientes números o escribir a los correos electrónicos:<br><br>
<ul>
    <li><a href="https://wa.me/59172207063">72207063</a> <a style="color:white" href="mailto:aflores@feicobol.com.bo"> aflores@feicobol.com.bo</a> Andrea Flores</li>
    <li><a href="https://wa.me/59172206073">72206073</a> <a href="mailto:jkent@feicobol.com.bo" style="color:white"> jkent@feicobol.com.bo</a> Juan Kent</li>
    <li><a href="https://wa.me/59172241462">72241462</a> <a style="color:white" href="mailto:parze@feicobol.com.bo"> parze@feicobol.com.bo</a> Pamela Arze</li>
</ul><br><br>
NOTA: El presente mensaje no requiere respuesta, es solo con motivo de informacion.
</body>
</html>