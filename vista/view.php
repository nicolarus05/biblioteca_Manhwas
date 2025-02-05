<?php
    class View{
        public static function mostrar($nombreVista, $datos=null){
            include("viewHeader.php");
            include("$nombreVista.php");
            include("viewFooter.php");
        }
    }
?>