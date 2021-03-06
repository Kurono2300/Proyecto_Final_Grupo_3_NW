<?php
class Utils {
    public static function DeleteSession($session) {
        if (isset($_SESSION[$session])) {
            $_SESSION[$session] = NULL;
            unset($_SESSION[$session]);
        }
    }
    public static function ShowError($error) {
        $sError = '';
        if (isset($_SESSION['errores'][$error])) {
            $sError = '<p class=" my-2 btn-danger p-2 rounded">Formato de ' . $error . ' incorrecto </p>';
        }
        if(isset($_SESSION['errores'][$error]) && $error == 'contraseña'){
            //echo '<script>alert("La contraseña debe tener lo siguiente: 8 caracteres minimo. Entre ellos debe haber 1 mayuscula, 1 numero, 1 caracter especial.")</script>';
            $sError = '<p class=" my-2 btn-danger p-2 rounded">Formato de ' . $error . ' incorrecto. Requisitos: 8 caracteres minimo. 1 mayuscula, 1 numero y 1 caracter especial. </p>';
        }
        if($error == 'error_login'){
            echo '<script>alert("Usuario o Contraseña Incorrecta")</script>';
        }
        return $sError;
    }
    public static function isAdmin() {
        if (!isset($_SESSION['admin'])) {
            header("location: " . base_url);
        }else{
            return TRUE;
        }
    }
    public static function showCategorias() {
        require_once 'models/CategoriasModels.php';
        $categ = new CategoriasModels();
        $catego = $categ->getAll();
        return $catego;
    }
    public static function statsCarrito(){
        $stats = array(
            'total' => 0,
            'cantidad' => 0
        );
        if(isset($_SESSION['carrito'])){
        $stats['cantidad'] = count($_SESSION['carrito']);
        foreach ($_SESSION['carrito'] as $producto) {
             $stats['total'] += $producto['precio'] * $producto['unidades'];
        }

        }
        return $stats;
    }
    public static function showEstado($estado){
        $value = 'pendiente';
        if($estado == 'confirmed'){
            $value = 'pendiente';
        }elseif($estado == 'preparation'){
            $value = 'En proceso';
        }elseif($estado == 'ready'){
            $value = 'Listo para enviar';
        }elseif($estado == 'sended'){
            $value = 'Enviado';
        }
        return $value;
    }
}