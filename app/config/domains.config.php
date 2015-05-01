<?php
$DOM["KRAUFF"]["INITIALVALUE"]	= 1;
//$DOM["SYSTEMNAME"] = "MOON FrameWork <sup>2.2</sup>";
$DOM["SYSTEMNAME"] = "Biblio - Software para bibliotecas ";


$DOM["FMESSAGE"]["success"] = 1;
$DOM["FMESSAGE"]["warning"] = 2;
$DOM["FMESSAGE"]["error"] = 3;
$DOM["FMESSAGE"]["info"] = 4;


$DOM["GENERO"][1] = "Masculino";
$DOM["GENERO"][2] = "Femenino";


$DOM["TIPOOPERACION"][1] = "Creacion";
$DOM["TIPOOPERACION"][2] = "eliminacion";
$DOM["TIPOOPERACION"][3] = "actualizacion";


//Componente Parking - Tipos de tarifas
$DOM["TIPOTARIFA"][1] = "Personalizada";
$DOM["TIPOTARIFA"][2] = "Normal";

////Componente Parking -  Reglas para las Tarifas (Si ajusta esta linea debe ajustar el archivo reglas.js)
$DOM["REGLASTARIFA"][1] = "Mayor Que";
$DOM["REGLASTARIFA"][2] = "Mayor Igual Que";
$DOM["REGLASTARIFA"][3] = "Menor Que";
$DOM["REGLASTARIFA"][4] = "Menor Igual Que";



//EN revisión, no utilizar ......
$DOM["SISTEMAS"]["COMUN"] = 0;
$DOM["SISTEMAS"]["EVA_DOCENTE"] = 1;
$DOM["SISTEMAS"]["ACOMPANAMIENTO"] = 2;
$DOM["SISTEMAS"]["CAPACITACIONES"] = 3;
$DOM["SISTEMAS"]["AUTOEVALUACION"] = 4;

$DOM["NOMBRESISTEMA"][$DOM["SISTEMAS"]["EVA_DOCENTE"]] = "Evaluación Docente";
$DOM["NOMBRESISTEMA"][$DOM["SISTEMAS"]["ACOMPANAMIENTO"]] = "Acompañamiento";
$DOM["NOMBRESISTEMA"][$DOM["SISTEMAS"]["CAPACITACIONES"]] = "Capacitaciones";
$DOM["NOMBRESISTEMA"][$DOM["SISTEMAS"]["AUTOEVALUACION"]] = "Autoevaluación y Calidad";

//Observación: hay que analizar la posibilidad de cambiar o quitar los siguientes:
$DOM["ID_SISTEMA"]["AUTH"] = 0;
$DOM["ID_SISTEMA"]["EVADOC"] = 1;
$DOM["ID_SISTEMA"]["ODAa"] = 2;
$DOM["ID_SISTEMA"]["OACA"] = 3;
$DOM["ID_SISTEMA"]["ODAc"] = 4;
//FIN Observación



$DOM["IF"][1] = "Si";
$DOM["IF"][2] = "No";

$DOM["NIVEL"]["Avanzado"] = "Avanzado";
$DOM["NIVEL"]["Intermedio"] = "Intermedio";
$DOM["NIVEL"]["Básico"] = "Básico";

$DOM["VISIBILIDAD"]["Visible"] = 1;
$DOM["VISIBILIDAD"]["Oculto"] = 2;

$DOM["TIPODOC"]["CC"] = "Cédula";
$DOM["TIPODOC"]["TI"] = "Tarjeta Identidad";
$DOM["TIPODOC"]["PA"] = "Pasaporte";
$DOM["TIPODOC"]["CE"] = "Cédula Extranjería";
$DOM["TIPODOC"]["NIT"] = "Nit";

$DOM["PERFIL"]["Administrador"]	= 1;
$DOM["PERFIL"]["Directivo"]     = 2;
$DOM["PERFIL"]["Coordinador"]	= 3;
$DOM["PERFIL"]["Docente"]       = 4;
$DOM["PERFIL"]["Estudiante"]    = 5;
$DOM["PERFIL"]["Administrativo"]= 6;
$DOM["PERFIL"]["Aspirante"]= 7;

//Evaluación Docente
$DOM["TIPOASIGNACION"]["EVALUADO"] = 1;
$DOM["TIPOASIGNACION"]["EVALUADOR"] = 2;
$DOM["TIPOASIGNACION"]["DISPONIBLE"] = 3;
$DOM["TIPOASIGNACION"]["EJSJ"] = 4;

$DOM["EVALUACION"]["MAXIMO_VALOR"] = 10;
$DOM["EVALUACION"]["MAXIMO_VALOR"] = 10;

$DOM["CAPACITACION"]["Orientador"] = 1;
$DOM["CAPACITACION"]["Participante"] = 2;
$DOM["CAPACITACION"]["ESTCURSO"]["0"] = "En curso";
$DOM["CAPACITACION"]["ESTCURSO"]["1"] = "Aprobado";
$DOM["CAPACITACION"]["ESTCURSO"]["2"] = "No aprobado";
$DOM["CAPACITACION"]["ESTCURSO"]["3"] = "Desertó";


$DOM["PESOSCAT"][1][2] = 50;
$DOM["PESOSCAT"][1][16] = 20;
$DOM["PESOSCAT"][1][7] = 30;
$DOM["PESOSCAT"][2][2] = 20;
$DOM["PESOSCAT"][2][16] = 20;
$DOM["PESOSCAT"][2][9] = 60;
$DOM["PESOSCAT"][3][2] = 50;
$DOM["PESOSCAT"][3][16] = 20;
$DOM["PESOSCAT"][3][12] = 30;
$DOM["PESOSCAT"][4][2] = 70;
$DOM["PESOSCAT"][4][16] = 30;
$DOM["PESOSCAT"][6][2] = 70;
$DOM["PESOSCAT"][6][16] = 30;

//OUTSIDE
$DOM["OUTSIDE"]["General"] = 1;
$DOM["OUTSIDE"]["Institucional"] = 2;
$DOM["OUTSIDE"]["Reconocimiento"] = 3;

//OUTSIDE
$DOM["OUTSIDE_NOTICIAS"][1] = "General";
$DOM["OUTSIDE_NOTICIAS"][2] = "Institucional";
$DOM["OUTSIDE_NOTICIAS"][3] = "Reconocimiento";
$DOM["OUTSIDE_NOTICIAS"][19]="Estudiantes";
$DOM["OUTSIDE_NOTICIAS"][20]="Docentes";
$DOM["OUTSIDE_NOTICIAS"][21]="Administrativos";
$DOM["OUTSIDE_NOTICIAS"][22]="Graduados";




//Autoevaluacion OACA
$DOM["AUTOEVALUACION"]["Factores"]              = 1;
$DOM["AUTOEVALUACION"]["Características"]       = 2;
$DOM["AUTOEVALUACION"]["Aspectos"]              = 3;
$DOM["AUTOEVALUACION"]["Indicadores"]           = 4;
$DOM["AUTOEVALUACION"]["Indicador Documental"]  = 5;
$DOM["AUTOEVALUACION"]["Indicador Estadístico"] = 6;
$DOM["AUTOEVALUACION"]["Indicador Opinión"]     = 7;


$DOM["AUTOEVALUACION"]["Abierto"] = 1;
$DOM["AUTOEVALUACION"]["Cerrado"] = 2;

$DOM["AUTOEVALUACION"]["Criterios"] = 1;
$DOM["AUTOEVALUACION"]["Juicios"] = 2;

$DOM["AUTOEVALUACION"]["limiteI"] = 0;
$DOM["AUTOEVALUACION"]["limiteS"] = 1;

$DOM["COMUNICADOS"][2] = "Abierto";
$DOM["COMUNICADOS"][1] = "Cerrado";

$DOM["CLASE_COMUNICADOS"][1] = "Normal";
$DOM["CLASE_COMUNICADOS"][2] = "Urgente";

$DOM["TIPO_COMUNICADOS"][1] = "Evento";
$DOM["TIPO_COMUNICADOS"][2] = "Circular";
$DOM["TIPO_COMUNICADOS"][3] = "PQR";
$DOM["TIPO_COMUNICADOS"][4] = "Contáctenos";
?>