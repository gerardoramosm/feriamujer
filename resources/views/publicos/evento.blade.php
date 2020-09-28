@extends('layouts.app',['vals'=>true])
@section('content')
<div class="slider_area slider_bg_1">
    <div class="whole-wrap">
        <div class="container box_1170">
            <div class="section-top-border" style="padding:0 !important">
                <!--<img src="{{asset('img/afiche-final.jpg')}}" width="100%">-->
                    <iframe src="//v.calameo.com/?bkcode=006351105a8394909f3d3" width="100%" height="450" frameborder="0" scrolling="no" allowtransparency allowfullscreen style="margin:0 auto;">
                    </iframe>
                    <!--
                    <div class="row">
                    <div class="col-md-3">
                        <img src="{{asset('img/logo-colores.png')}}" alt="" class="img-fluid">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">La Expo Mascotas</a>
                            <a class="nav-link" id="v-pills-rubros-tab" data-toggle="pill" href="#v-pills-rubros" role="tab" aria-controls="v-pills-rubros" aria-selected="false">Rubros Participantes</a>
                            <a class="nav-link" id="v-pills-ventajas-tab" data-toggle="pill" href="#v-pills-ventajas" role="tab" aria-controls="v-pills-ventajas" aria-selected="false">Ventajas</a>
                            <a class="nav-link" id="v-pills-experiencia-tab" data-toggle="pill" href="#v-pills-experiencia" role="tab" aria-controls="v-pills-experiencia" aria-selected="false">Experiencia Virtual</a>
                            <a class="nav-link" id="v-pills-e-stand-tab" data-toggle="pill" href="#v-pills-e-stand" role="tab" aria-controls="v-pills-e-stand" aria-selected="false">El e-stand</a>
                            <a class="nav-link" id="v-pills-contacto-tab" data-toggle="pill" href="#v-pills-contacto" role="tab" aria-controls="v-pills-contacto" aria-selected="false">Contacto</a>
                          </div>
                    </div>
                    <div class="col-md-9 mt-sm-20">
                        <div class="row">
                          <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" style="text-align: justify">
                                <h3 class="mb-30">La Expo Mascotas</h3>
                                <span >Feicobol y la Cámara de Comercio y Servicios de Cochabamba, con el propósito de innovar para adaptarse a la nueva realidad generada por el COVID - 19 y generar movimiento económico a las empresas del país, organizan la Feria de Salud y Bienestar – FEXPO SALUD, una plataforma de negocios virtual  que reúne a  las empresas e instituciones más representativas del mercado alrededor de una muestra comercial de productos y servicios relacionados a los sectores de medicina,  bioseguridad, bienestar, alimentación saludable,  belleza y vida activa, complementado con una agenda de actividades donde se desarrollarán: rueda de negocios, webinars, demostraciones y presentaciones empresariales.</span>
                            </div>
                            <div class="tab-pane fade" id="v-pills-rubros" role="tabpanel" aria-labelledby="v-pills-rubros-tab">
                                <h3 class="mb-30">Rubros participantes</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="single-defination">
                                            <h4 class="mb-20">Salud y Medicina</h4>
                                            <ul class="unordered-list" style="text-align: justify">
                                                <li>Centros de salud público y privado</li>
                                                <li>Clínicas y hospitales</li>
                                                <li>Clínicas odontológicas</li>
                                                <li>Ópticas y clínicas oftalmológicas</li>
                                                <li>Laboratorios clínicos y farmacéuticos</li>
                                                <li>Importadoras de insumos médicos y productos asociados al rubro</li>
                                                <li>Empresas dedicadas a la fabricación de medicamentos</li>
                                                <li>Gabinetes de fisioterapia y kinesiología</li>
                                                <li>Centros de prevención de enfermedades</li>
                                                <li>Seguros de Salud</li>
                                                <li>Servicios tecnológicos dirigido a la medicina</li>
                                                <li>Empresas con programas de RSE en salud</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-defination">
                                            <h4 class="mb-20">Bienestar</h4>
                                            <ul class="unordered-list" style="text-align: justify">
                                                <li>Centros de bienestar y terapéuticos</li>
                                                <li>Spas y centros de relajación</li>
                                                <li>Centros de yoga y pilates</li>
                                                <li>Centros de medicina alternativa y tradicional</li>
                                                <li>Servicios de terapias de descanso</li>
                                                <li>Medicina Alternativa</li>
                                            </ul>
                                            <br>
                                            <h4 class="mb-20">Alimentación Saludable</h4>
                                            <ul class="unordered-list" style="text-align: justify">
                                                <li>Alimentos orgánicos y naturales</li>
                                                <li>Productos dietéticos</li>
                                                <li>Complementos alimenticios y Energéticos</li>
                                                <li>Centros de Nutrición</li>
                                                <li>Cocina Saludable</li>
                                                <li>Variedad de Fiambres, quesos y panes</li>
                                                <li>Acompañamientos y Salsas/Chutneys</li>
                                                <li>Snacks</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-defination">
                                            <h4 class="mb-20">Vida Activa</h4>
                                            <ul class="unordered-list" style="text-align: justify">
                                                <li>Health Coachs</li>
                                                <li>Gabinetes estéticos</li>
                                                <li>Equipamiento y Ropa Deportiva</li>
                                            </ul>
                                            <br>
                                            <h4 class="mb-20">Bioseguridad</h4>
                                            <ul class="unordered-list" style="text-align: justify">
                                                <li>Productos y equipos de protección</li>
                                                <li>Productos y servicios de limpieza y desinfección</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-ventajas" role="tabpanel" aria-labelledby="v-pills-ventajas-tab">
                                <h3 class="mb-30">Ventajas de la Feria</h3>
                                <ul class="unordered-list" style="text-align: justify">
                                    <li>REDUCCION EN COSTES<br>Ahorro en gastos de producción, montaje, alojamientos y traslados.</li>
                                    <li>ALCANCE GLOBAL<br>Acceso nacional e internacional, desde cualquier dispositivo con conexión a internet.</li>
                                    <li>CONCEPTO 24/7<br>Abierto las 24 horas durante 7 días.</li>
                                    <li>CONECTA E INTERACTÚA<br>Exposición interactiva: contacto con clientes y proveedores globales.</li>
                                    <li>MERCADO VIRTUAL<br>Promoción de productos, impulso de ventas y posicionamiento de marca.</li>
                                    <li>CAPTURA DE CONTACTOS ÚTILES<br>Medición de visitas individuales a stands.</li>
                                    <li>EVENTO VERDE<br>Disminuye la huella de carbono.</li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="v-pills-experiencia" role="tabpanel" aria-labelledby="v-pills-experiencia-tab">
                                <h3 class="mb-30">Experiencia Virtual</h3>
                                <ul class="unordered-list" style="text-align: justify">
                                    <li>STANDS VIRTUALES<br>La mejor oferta al alcance de un clic<br>Más de 70 expositores.</li>
                                    <li>AUDITORIO VIRTUAL<br>Webinars y/o conferencias, actividades demostrativas y presentaciones empresariales.</li>
                                    <li>RUEDA DE NEGOCIOS EN LÍNEA<br>Oferta y demanda de productos y servicios.<br>Contacto con compradores locales, nacionales e internacionales.</li>
                                    <li>VISITANTES<br>Visita e interacción sin límites físicos ni geográficos<br>Gratuito 24 horas.<br>Más de 10 mil visitantes.</li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="v-pills-e-stand" role="tabpanel" aria-labelledby="v-pills-e-stand-tab">
                                <div class="row">
                                    <div class="col-sm">
                                        <h3 class="mb-30">El e-stand</h3>
                                        <ul class="unordered-list" style="text-align: justify">
                                            <li>INFO EMPRESAS<br>Información general de empresas/marcas, datos de contacto, geolocalización e integración con web y redes sociales del expositor.</li>
                                            <li>CATALOGO EXPOSITORES<br>Detalle de productos y servicios con precios.</li>
                                            <li>PROMOCIONES<br>Ofertas y descuentos de productos y servicios.</li>
                                            <li>GALERIA<br>Imágenes/artes de productos y servicios.</li>
                                        </ul>
                                            </div>
                                    <div class="col-sm">
                                        <h3 class="mb-30">Qué incluye el e-stand?</h3>
                                        <ul class="unordered-list" style="text-align: justify">
                                            <li>Logotipo empresarial.</li>
                                            <li>Datos de contacto.</li>
                                            <li>Descripción de la empresa (200 caracteres).</li>
                                            <li>Geolocalización.</li>
                                            <li>Enlace a web y redes sociales del expositor.</li>
                                            <li>Catálogo de productos y/o servicios.</li>
                                            <li>Productos con descuentos.</li>
                                            <li>Contenidos complementarios.</li>
                                            <li>10 Fotografías y 2 enlaces de Videos multimedia.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-contacto" role="tabpanel" aria-labelledby="v-pills-contacto-tab">
                                <h3 class="mb-30">Contactos</h3>
                                <h4 class="mb-30">FEICOBOL - Departamento Comercial</h4>
                                <ul class="unordered-list row" style="text-align: justify">
                                    <li ><span class="text">Andrea Flores</span>
                                    <br><a href="https://wa.me/59172207063?text=Quiero%20participar%20en%20la%feria" target="_blank"><span class="icon icon-whatsapp"></span><span class="text">72207063</a></span>
                                    <br><a href="mailto:aflores@feicobol.com.bo" target="_blank"><span class="icon icon-envelope"></span></ion-icon><span class="text">aflores@feicobol.com.bo</a></span></li>
                                    <li ><span class="text">Juan Kent</span>
                                    <br><a href="https://wa.me/59172206073?text=Tengo%20dudas%20sobre%20la%feria" target="_blank"><span class="icon icon-whatsapp"></span><span class="text">72206073</a></span>
                                    <br><a href="mailto:jkent@feicobol.com.bo" target="_blank"><span class="icon icon-envelope"></span></ion-icon><span class="text">jkent@feicobol.com.bo</a></span></li>
                                    <li><span class="text">Pamela Arze</span>
                                    <br><a href="https://wa.me/59172241462?text=Tengo%20dudas%20sobre%20la%feria" target="_blank"><span class="icon icon-whatsapp"></span><span class="text">72241462</a></span>
                                    <br><a href="mailto:parze@feicobol.com.bo" target="_blank"><span class="icon icon-envelope"></span></ion-icon><span class="text">parze@feicobol.com.bo</a></span></li>
                                </ul>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <div class="countDOwn_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-md-6 col-lg-3">
                    <div class="single_date">
                        <i class="ti-alarm-clock"></i>
                        <span>17 al 23 de Septiembre 2020</span>
                    </div>
                    <!--    <div class="single_date">
                        <i class="ti-location-pin"></i>
                        <span>City Hall, New York City</span>
                    </div>-->
                </div>
                <div class="col-xl-6 col-md-12 col-lg-6">
                    <span id="clock"></span>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-3" style="text-align: right">
                    <a href="https://wa.me/59172207063?text=Hola,%20quisiera%20m%C3%A1s%20informaci%C3%B3n%20para%20ser%20expositor" class="boxed-btn-red">Quiero Exponer</a>
                </div>

            </div>
        </div>
    </div>
</div>
<!--<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <h3 class="mb-30">La Fexpo Salud</h3>
            <div class="row">
                <div class="col-md-5">
                    <img src="{{asset('fv/images/imagen.jpg')}}" alt="" class="img-fluid">
                </div>
                <div class="col-md-7 mt-sm-20">
                    <p style="text-align: justify">Con la progresiva reapertura de la actividad empresarial en el período de confinamiento y con la certeza de la importancia de los eventos de negocios en la reactivación económica, se ha puesto en marcha el Festival de Invierno que combinará la exposición comercial virtual de productos con actividades profesionales y culturales online.
                        <br>Se constituye en un encuentro comercial donde se dan cita empresas locales y nacionales, para dar a conocer y ofertar aquellos productos vinculados a la época de invierno enmarcadas en los sectores: textil, artículos para el hogar, alimentos y bebidas.
                        <br>Y aunque no sea San Juan todos los días del Festival, también es una buena excusa para que los emprendedores puedan ofertar los sabores y productos que tradicionalmente se consume en la noche más fría del año: salchichas, fiambres, panes, quesos,  infusiones, vinos, singanis, licores, cerveza… 
                        <br>Es la oportunidad para vivir una experiencia virtual diferente con un programa que incluye talleres y conciertos musicales con artistas locales, que se transmitirá en streaming  para que puedan ser seguidas online a través nuestras redes sociales. 
                        <br>¡Participa! del Festival de Invierno que reunirá en 29 días la oferta de productos de gran consumo en época de frío en nuestro país.</p>
                </div>
            </div>
        </div>
        <div class="section-top-border">
            <h3>QUÉ ES EL FESTIVAL DE INVIERNO</h3>
            <div class="">
                <ul class="unordered-list" style="text-align: justify">
                    <li>Es una plataforma virtual de enlace comercial entre expositores, compradores y visitantes, a nivel nacional, orientado a promover la compra – venta de productos de gran consumo, vinculados a la época invernal, de los sectores textil, artículos para el hogar, alimentos y bebidas. Combina la exposición comercial de productos con actividades profesionales y culturales online.</li>
                    <li>Permite al expositor contar con un stand en la que muestre digitalmente su marca, productos y servicios</li>
                    <li>Es un escaparate que permanecerá activo durante una semana y mediante el cual se pretende ayudar en la estrategia de presencia en el mercado de las empresas expositoras a través del posicionamiento digital.</li>
                    <li>La plataforma está diseñada para facilitar al participante un acceso por internet rápido y fácil. </li>
                    <li>Da la posibilidad de acceder desde cualquier dispositivo (Tablet, celular, computadora) brindando la oportunidad de negocio sin tener que salir del hogar u oficina.</li>
                </ul>
            </div>
        </div>
        <div class="section-top-border">
            <h3 class="mb-30">PERFIL DE EXPOSITORES</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="single-defination">
                        <h4 class="mb-20">Industria y Comercio textil</h4>
                        <ul class="unordered-list" style="text-align: justify">
                            <li>Prendas de vestir de invierno</li>
                            <li>Calzados de cuero y otros materiales</li>
                            <li>Accesorios de moda</li>
                            <li>Ropa de casa</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-defination">
                        <h4 class="mb-20">Industria y Comercio de Artículos para el Hogar</h4>
                        <ul class="unordered-list" style="text-align: justify">
                            <li>Electrodomésticos</li>
                            <li>Equipos para el hogar</li>
                            <li>Menaje</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-defination">
                        <h4 class="mb-20">Empresas de Alimentos y Bebidas Alcohólicas y No Alcohólicas</h4>
                        <ul class="unordered-list" style="text-align: justify">
                            <li>Vinos, Singanis, licores y otras bebidas nacionales y extranjeras</li>
                            <li>Cervezas artesanales</li>
                            <li>Variedad de bebidas No Alcohólicas</li>
                            <li>Infusiones</li>
                            <li>Productos alimenticios Delicatessen</li>
                            <li>Variedad de Fiambres, quesos y panes</li>
                            <li>Acompañamientos y Salsas/Chutneys</li>
                            <li>Snacks</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-top-border">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-defination">
                        <h4 class="mb-20">PERFIL DEL VISITANTE Y COMPRADOR</h4>
                        <ul class="unordered-list" style="text-align: justify">
                            <li>Distribuidoras</li>
                            <li>Comerciantes</li>
                            <li>Amas de casa</li>
                            <li>Público en General</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-defination">
                        <h4 class="mb-20">VENTAJAS DE PARTICIPACIÓN</h4>
                        <ul class="unordered-list" style="text-align: justify">
                            <li>Acceso a una nueva plataforma de negocios</li>
                            <li>Interrelación con empresas de distintos sectores</li>
                            <li>Contacto con compradores locales y nacionales</li>
                            <li>Establecimiento y ampliación de la cartera de clientes</li>
                            <li>Reforzar presencia en el mercado</li>
                            <li>Incrementar ventas</li>
                            <li>Posicionamiento de marca</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-defination">
                        <h4 class="mb-20">ACTIVIDADES COMPLEMENTARIAS VIRTUALES</h4>
                        <ul class="unordered-list" style="text-align: justify">
                            <li>Workshops/Demostraciones de productos</li>
                            <li>Concierto Musical de Invierno</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-top-border">
            <h3 class="mb-30">Inversión</h3>
            <div class="row">
                <div class="col-lg-12">
                    <blockquote class="generic-blockquote">
                        Stand virtual
                        <strong> Bs. 250 </strong>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
    @guest
    <div class="resister_book resister_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="resister_text text-center">
                        <h3>Regístrate como expositor</h3>
                        <a href="{{ route('register') }}" class="boxed-btn-red">Regístrate Aquí </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endguest
-->
</div>

@endsection