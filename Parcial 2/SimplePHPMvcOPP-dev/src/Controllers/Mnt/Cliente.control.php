<?php 
namespace Controllers\Mnt;

class Cliente extends \Controllers\PublicController
{
    private $clientid = 0;
    private $clientname = "";
    
    private $clientgender = "";
    private $clientgender_M = "";
    private $clientgender_F = "";

    private $clientphone1 = ""; 
    private $clientphone2 = "";
    private $clientemail = "";
    private $clientIdnumber = ""; 
    private $clientbio = "";

    private $clientstatus = "";
    private $clientstatus_ACT = "";
    private $clientstatus_INA = "";
    private $clientstatus_PLN = "";

    private $clientdatecrt  = "";
    private $clientusercreates = "";

    private $mode_dsc = "";
    private $mode_adsc = array(
        "INS" => "Nuevo Cliente",
        "UPD" => "Editar %s %s",
        "DEL" => "Eliminar %s %s",
        "DSP" => "%s %s"
    );

    private $readonly = "";
    private $showaction= true;

    private $hasErrors = false;
    private $aErrors = array();

    public function run() :void
    {
        /*
        1) Verificamos si es un postback o un get
        2) si es un get simplemente obtenemos datos y mostramos datos
        3) si es un post
          3.1) validamos datos del post
          3.2) realizamos la acción segun el modo del post
          3.3) verificamos el resultado de la acción
            3.3.1) si hay errores mostramos los errores en pantalla
            3.3.2) si no hay errores, mostramos mensaje de exito
                    y redirigimos a la lista
         */
        $this->mode = isset($_GET["mode"])?$_GET["mode"]:"";
        $this->clientid = isset($_GET["clientid"])?$_GET["clientid"]:0;
        if (!$this->isPostBack()) {
            if ($this->mode !== "INS") {
                $this->_load();
            } else {
                $this->mode_dsc = $this->mode_adsc[$this->mode];
            }
        } else {
            $this->_loadPostData();
            if (!$this->hasErrors) {
                switch ($this->mode){
                case "INS":
                    if (\Dao\Mnt\Clientes::insert($this->clientname, $this->clientgender, $this->clientphone1, $this->clientphone2, $this->clientemail, $this->clientIdnumber, $this->clientbio, $this->clientstatus, $this->clientdatecrt, $this->clientusercreates)) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_clientes",
                            "Cliente Agregado Satisfactoriamente!"
                        );
                    }
                    break;
                case "UPD":
                    if (\Dao\Mnt\Clientes::update($this->clientname, $this->clientgender, $this->clientphone1, $this->clientphone2, $this->clientemail, $this->clientIdnumber, $this->clientbio, $this->clientstatus, $this->clientdatecrt, $this->clientusercreates, $this->clientid)) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_clientes",
                            "Cliente Actualizado Satisfactoriamente!"
                        );
                    }
                    break;
                case "DEL":
                    if (\Dao\Mnt\Clientes::delete($this->clientid)) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_clientes",
                            "Cliente Eliminado Satisfactoriamente!"
                        );
                    }
                    break;
                }
            }
        }

        $dataview = get_object_vars($this);
        \Views\Renderer::render("mnt/cliente", $dataview);
    }

    private function _load()
    {
        $_data = \Dao\Mnt\Clientes::getOne($this->clientid);
        if ($_data) {
            $this->clientid = $_data["clientid"];
            $this->clientname = $_data["clientname"];
            $this->clientgender = $_data["clientgender"];
            $this->clientphone1 = $_data["clientphone1"];
            $this->clientphone2 = $_data["clientphone2"];
            $this->clientemail = $_data["clientemail"];
            $this->clientIdnumber = $_data["clientIdnumber"];
            $this->clientbio = $_data["clientbio"];

            $this->clientstatus = $_data["clientstatus"];

            $this->clientdatecrt = $_data["clientdatecrt"];
            $this->clientusercreates = $_data["clientusercreates"];
            $this->_setViewData();
        }
    }

    private function _loadPostData()
    {
        $this->clientid = isset($_POST["clientid"]) ? $_POST["clientid"] : 0 ;
        $this->clientname = isset($_POST["clientname"]) ? $_POST["clientname"] : "" ;

        $this->clientgender = isset($_POST["clientgender"]) ? $_POST["clientgender"] : "M" ;
        $this->clientphone1 = isset($_POST["clientphone1"]) ? $_POST["clientphone1"] : "" ;
        $this->clientphone2 = isset($_POST["clientphone2"]) ? $_POST["clientphone2"] : "" ;
        $this->clientemail = isset($_POST["clientemail"]) ? $_POST["clientemail"] : "" ;
        $this->clientIdnumber = isset($_POST["clientIdnumber"]) ? $_POST["clientIdnumber"] : "" ;
        $this->clientbio = isset($_POST["clientbio"]) ? $_POST["clientbio"] : "" ;

        $this->clientstatus = isset($_POST["clientstatus"]) ? $_POST["clientstatus"] : "ACT" ;

        $this->clientdatecrt = isset($_POST["clientdatecrt"]) ? $_POST["clientdatecrt"] : "" ;
        $this->clientusercreates = isset($_POST["clientusercreates"]) ? $_POST["clientusercreates"] : "" ;
        //validaciones
        //aplicar todas la reglas de negocio
        if (preg_match('/^\s*$/', $this->clientname)) {
            $this->aErrors[] = "¡El cliente no puede ir vacio!";
        }
        //
        $this->hasErrors = (count($this->aErrors) > 0);
        $this->_setViewData();
    }

    private function _setViewData()
    {
        $this->clientstatus_ACT = ($this->clientstatus === "ACT") ? "selected" : "";
        $this->clientstatus_INA = ($this->clientstatus === "INA") ? "selected" : "";
        $this->clientstatus_PLN = ($this->clientstatus === "PLN") ? "selected" : "";

        $this->clientgender_M = ($this->clientgender === "MAS") ? "selected" : "";
        $this->clientgender_F = ($this->clientgender === "FEM") ? "selected" : "";

        

        $time = strtotime($this->clientdatecrt);
        $newformat = date('Y-m-d',$time);
        $this->clientdatecrt = $newformat;


        $this->mode_dsc = sprintf(
            $this->mode_adsc[$this->mode],
            $this->clientid,
            $this->clientname
        );
        $this->readonly = ($this->mode =="DEL" || $this->mode=="DSP") ? "readonly":"";
        $this->showaction = !($this->mode == "DSP");
    }
}

?>
