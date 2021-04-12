<?php 
namespace Controllers\Mnt;

class Usuario extends \Controllers\PublicController
{
    private $usercod = 0;
    private $useremail = "";

    private $username = ""; 
    private $userpswd = "";
    private $userfching = "";
    
    private $userpswdest = "";
    private $userpswdest_ACT = "";
    private $userpswdest_INA = "";

    private $userpswdexp  = "";

    private $userest = "";
    private $userest_ACT = "";
    private $userest_INA = "";
    private $userest_BLQ = "";
    private $userest_SUS = "";

    private $useractcod = "";
    private $userpswdchg = "";

    private $usertipo = "";
    private $usertipo_PBL = "";
    private $usertipo_ADM = "";
    private $usertipo_AUD = "";
    

    private $mode_dsc = "";
    private $mode_adsc = array(
        "INS" => "Nuevo Usuario",
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
        $this->usercod = isset($_GET["usercod"])?$_GET["usercod"]:0;
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
                    if (\Dao\Mnt\Usuarios::insert($this->useremail, $this->username, $this->userpswd, $this->userfching, $this->userpswdest, $this->userpswdexp, $this->userest, $this->useractcod, $this->userpswdchg, $this->usertipo)) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_usuarios",
                            "Usuario Agregado Satisfactoriamente!"
                        );
                    }
                    break;
                case "UPD":
                    if (\Dao\Mnt\Usuarios::update($this->useremail, $this->username, $this->userpswd, $this->userfching, $this->userpswdest, $this->userpswdexp, $this->userest, $this->useractcod, $this->userpswdchg, $this->usertipo, $this->usercod)) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_usuarios",
                            "Usuario Actualizado Satisfactoriamente!"
                        );
                    }
                    break;
                case "DEL":
                    if (\Dao\Mnt\Usuarios::delete($this->usercod)) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_usuarios",
                            "Usuario Eliminado Satisfactoriamente!"
                        );
                    }
                    break;
                }
            }
        }

        $dataview = get_object_vars($this);
        \Views\Renderer::render("mnt/usuario", $dataview);
        // \Dao\Security\Security::_hashPassword("$this->userpswd");
        //hash("sha256", $this->useremail.time())
    }

    private function _load()
    {
        $_data = \Dao\Mnt\Usuarios::getOne($this->usercod);
        if ($_data) {
            $this->usercod = $_data["usercod"];
            $this->useremail = $_data["useremail"];
            $this->username = $_data["username"];
            // $this->userpswd = $_data["userpswd"];
            $this->userfching = $_data["userfching"];
            $this->userpswdest = $_data["userpswdest"];
            $this->userpswdexp = $_data["userpswdexp"];
            $this->userest = $_data["userest"];
            $this->useractcod = $_data["useractcod"];
            $this->userpswdchg = $_data["userpswdchg"];
            $this->usertipo = $_data["usertipo"];
            $this->_setViewData();
        }
    }

    private function _loadPostData()
    {
        $this->usercod = isset($_POST["usercod"]) ? $_POST["usercod"] : 0 ;
        $this->useremail = isset($_POST["useremail"]) ? $_POST["useremail"] : "" ;
        $this->username = isset($_POST["username"]) ? $_POST["username"] : "" ;
        // $this->userpswd = isset($_POST["userpswd"]) ? $_POST["userpswd"] : "" ;
        $this->userfching = isset($_POST["userfching"]) ? $_POST["userfching"] : "" ;
        $this->userpswdest = isset($_POST["userpswdest"]) ? $_POST["userpswdest"] : "ACT" ;
        $this->userpswdexp = isset($_POST["userpswdexp"]) ? $_POST["userpswdexp"] : "" ;
        $this->userest = isset($_POST["userest"]) ? $_POST["userest"] : "ACT" ;
        $this->useractcod = isset($_POST["useractcod"]) ? $_POST["useractcod"] : "" ;
        $this->userpswdchg = isset($_POST["userpswdchg"]) ? $_POST["userpswdchg"] : "" ;
        $this->usertipo = isset($_POST["usertipo"]) ? $_POST["usertipo"] : "PBL" ;

        //validaciones
        //aplicar todas la reglas de negocio
        if (preg_match('/^\s*$/', $this->usercod)) {
            $this->aErrors[] = "¡El Usuario no puede ir vacio!";
        }
        //
        $this->hasErrors = (count($this->aErrors) > 0);
        $this->_setViewData();
    }

    private function _setViewData()
    {
        $this->userest_ACT = ($this->userest === "ACT") ? "selected" : "";
        $this->userest_INA = ($this->userest === "INA") ? "selected" : "";
        $this->userest_PLN = ($this->userest === "PLN") ? "selected" : "";

        $this->userpswdest_ACT = ($this->userpswdest === "ACT") ? "selected" : "";
        $this->userpswdest_INA = ($this->userpswdest === "INA") ? "selected" : "";

        $this->usertipo_PBL = ($this->usertipo === "PBL") ? "selected" : "";
        $this->usertipo_ADM = ($this->usertipo === "ADM") ? "selected" : "";
        $this->usertipo_AUD = ($this->usertipo === "AUD") ? "selected" : "";


        $time = strtotime($this->userfching);
        $newformat = date('Y-m-d',$time);
        $this->userfching = $newformat;

        $time2 = strtotime($this->userpswdexp);
        $newformat2 = date('Y-m-d',$time2);
        $this->userpswdexp = $newformat2;

        $time3 = strtotime($this->userpswdchg);
        $newformat3 = date('Y-m-d',$time3);
        $this->userpswdchg = $newformat3;

        
        $this->mode_dsc = sprintf(
            $this->mode_adsc[$this->mode],
            $this->usercod,
            $this->useremail
        );
        $this->readonly = ($this->mode =="DEL" || $this->mode=="DSP") ? "readonly":"";
        $this->showaction = !($this->mode == "DSP");
    }
}

?>
