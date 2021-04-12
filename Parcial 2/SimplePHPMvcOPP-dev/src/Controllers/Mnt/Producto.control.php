<?php 
namespace Controllers\Mnt;

class Producto extends \Controllers\PublicController
{
    private $invPrdId = 0;
    private $invPrdBrCod = "";

    private $invPrdCodInt = ""; 
    private $invPrdDsc = "";
    private $invPrdTip = "";
    
    private $invPrdEst = "";
    private $invPrdEst_ACT = "";
    private $invPrdEst_INA = "";
    private $invPrdEst_PLN = "";

    private $invPrdPadre = "";
    private $invPrdFactor  = "";
    private $invPrdVnd = "";

    private $mode_dsc = "";
    private $mode_adsc = array(
        "INS" => "Nuevo Producto",
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
        $this->invPrdId = isset($_GET["invPrdId"])?$_GET["invPrdId"]:0;
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
                    if (\Dao\Mnt\Productos::insert($this->invPrdBrCod, $this->invPrdCodInt, $this->invPrdDsc, $this->invPrdTip, $this->invPrdEst, $this->invPrdPadre, $this->invPrdFactor, $this->invPrdVnd)) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_productos",
                            "Producto Agregado Satisfactoriamente!"
                        );
                    }
                    break;
                case "UPD":
                    if (\Dao\Mnt\Productos::update($this->invPrdBrCod, $this->invPrdCodInt, $this->invPrdDsc, $this->invPrdTip, $this->invPrdEst, $this->invPrdPadre, $this->invPrdFactor, $this->invPrdVnd, $this->invPrdId)) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_productos",
                            "Producto Actualizado Satisfactoriamente!"
                        );
                    }
                    break;
                case "DEL":
                    if (\Dao\Mnt\Productos::delete($this->invPrdId)) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_productos",
                            "Producto Eliminado Satisfactoriamente!"
                        );
                    }
                    break;
                }
            }
        }

        $dataview = get_object_vars($this);
        \Views\Renderer::render("mnt/producto", $dataview);
    }

    private function _load()
    {
        $_data = \Dao\Mnt\Productos::getOne($this->invPrdId);
        if ($_data) {
            $this->invPrdId = $_data["invPrdId"];
            $this->invPrdBrCod = $_data["invPrdBrCod"];
            $this->invPrdCodInt = $_data["invPrdCodInt"];
            $this->invPrdDsc = $_data["invPrdDsc"];
            $this->invPrdTip = $_data["invPrdTip"];
            $this->invPrdEst = $_data["invPrdEst"];
            $this->invPrdPadre = $_data["invPrdPadre"];
            $this->invPrdFactor = $_data["invPrdFactor"];
            $this->invPrdVnd = $_data["invPrdVnd"];
            $this->_setViewData();
        }
    }

    private function _loadPostData()
    {
        $this->invPrdId = isset($_POST["invPrdId"]) ? $_POST["invPrdId"] : 0 ;
        $this->invPrdBrCod = isset($_POST["invPrdBrCod"]) ? $_POST["invPrdBrCod"] : "" ;
        $this->invPrdCodInt = isset($_POST["invPrdCodInt"]) ? $_POST["invPrdCodInt"] : "" ;
        $this->invPrdDsc = isset($_POST["invPrdDsc"]) ? $_POST["invPrdDsc"] : "" ;
        $this->invPrdTip = isset($_POST["invPrdTip"]) ? $_POST["invPrdTip"] : "" ;
        $this->invPrdEst = isset($_POST["invPrdEst"]) ? $_POST["invPrdEst"] : "ACT" ;
        $this->invPrdPadre = isset($_POST["invPrdPadre"]) ? $_POST["invPrdPadre"] : "" ;
        $this->invPrdFactor = isset($_POST["invPrdFactor"]) ? $_POST["invPrdFactor"] : "" ;
        $this->invPrdVnd = isset($_POST["invPrdVnd"]) ? $_POST["invPrdVnd"] : "" ;
        //validaciones
        //aplicar todas la reglas de negocio
        if (preg_match('/^\s*$/', $this->invPrdBrCod)) {
            $this->aErrors[] = "¡El producto no puede ir vacio!";
        }
        //
        $this->hasErrors = (count($this->aErrors) > 0);
        $this->_setViewData();
    }

    private function _setViewData()
    {
        $this->invPrdEst_ACT = ($this->invPrdEst === "ACT") ? "selected" : "";
        $this->invPrdEst_INA = ($this->invPrdEst === "INA") ? "selected" : "";
        $this->invPrdEst_PLN = ($this->invPrdEst === "PLN") ? "selected" : "";

        $this->mode_dsc = sprintf(
            $this->mode_adsc[$this->mode],
            $this->invPrdId,
            $this->invPrdBrCod
        );
        $this->readonly = ($this->mode =="DEL" || $this->mode=="DSP") ? "readonly":"";
        $this->showaction = !($this->mode == "DSP");
    }
}

?>
