<?php

namespace Hotel;

class Reserva implements IHotel{
    private $tipoH ="";
    private $nombreCliente = "";
    private $precio = 0;
    private $impuestoR = 0;
    private $impuestoH = 0;

    private $subtotal = 0;
    private $total = 0;


    //GETS
    public function getTipoH(){
        return $this->tipoH;
    }

    public function getNombreCliente(){
        return $this->nombreCliente;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function getImpuestoR(){
        return $this->impuestoR;
    }

    public function getImpuestoH(){
        return $this->impuestoH;
    }

    public function getSubtotal(){
        return $this->subtotal;
    }

    public function getTotal(){
        return $this->total;
    }


    

    public function calculoReserva($_vistaMar, $_desayunoInclu, $_numPersonitas, $_numDiasReserva){
        $subtotal = $this->precio;

        switch($_numPersonitas){
            case "1":
                $subtotal = $subtotal + 10;
            break;
            case "2":
                $subtotal = $subtotal + 20;
            break;
            case "3":
                $subtotal = $subtotal + 30;
            break;
            case "4":
                $subtotal = $subtotal + 40;
            break;
        }

        if($_vistaMar = "Si"){
            $subtotal = $subtotal + 100;
        }

        if($_desayunoInclu = "Si"){
            $subtotal = $subtotal + 50;
        }

        if($_numDiasReserva <= 10){
            $subtotal = $subtotal + 20;
        }
        else{
            $subtotal = $subtotal + 50;
        }

        $temp1 = $subtotal * 0.15;
        $temp2 = $subtotal * 0.18;
        $this->impuestoR = $temp1;
        $this->impuestoH = $temp2;
        $this->subtotal = $subtotal;

        $this->total = $subtotal + $temp1 + $temp2;

    }


    //CONSTRUCTOR
    public function __construct($_tipoH, $_nombreCliente){
        $this->tipoH = $_tipoH;
        $this->nombreCliente = $_nombreCliente;
        switch($_tipoH){
            case "Economica": //ECONOMICA
                $precioEcono = "200";
                $this->precio = $precioEcono;
                return;   
            case "Premium": //PREMIUM
                $precioEcono = "400";
                $this->precio = $precioEcono;
                return;
            case "Platino": //PLATINO
                $precioEcono = "600";
                $this->precio = $precioEcono;
                return;
        }

    }


}

?>

