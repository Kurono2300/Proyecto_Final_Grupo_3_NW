<h1>{{mode_dsc}}</h1>
<section>
  <form action="index.php?page=mnt_producto&mode={{mode}}&invPrdId={{invPrdId}}"
    method="POST" >
    <section>
    <label for="invPrdId">Id: </label>
    <input type="hidden" id="invPrdId" name="invPrdId" value="{{invPrdId}}"/>
    <input type="text" readonly name="invPrdIddummy" value="{{invPrdId}}"/>
    </section>
    <br/>
    <section>
        <label for="invPrdBrCod">BR COD: </label>
        <input type="text" {{readonly}} name="invPrdBrCod" value="{{invPrdBrCod}}" maxlength="45" placeholder="BR COD"/>
        <br/>
        <br/>
        <label for="invPrdCodInt">COD INT: </label>
        <input type="text" {{readonly}} name="invPrdCodInt" value="{{invPrdCodInt}}" maxlength="45" placeholder="COD INT"/>
        <br/>
        <br/>
        <label for="invPrdDsc">PRD DSC: </label>
        <input type="text" {{readonly}} name="invPrdDsc" value="{{invPrdDsc}}" maxlength="45" placeholder="PRD DSC"/>
        <br/>
        <br/>
        <label for="invPrdTip">PRD TIP: </label>
        <input type="text" {{readonly}} name="invPrdTip" value="{{invPrdTip}}" maxlength="3" placeholder="PRD TIP"/>
        <br/>
        <br/>
        <label for="invPrdEst">EST: </label>
        <select id="invPrdEst" name="invPrdEst" {{if readonly}}disabled{{endif readonly}}>
            <option value="ACT" {{invPrdEst_ACT}}>Activo</option>
            <option value="INA" {{invPrdEst_INA}}>Inactivo</option>
            <option value="PLN" {{invPrdEst_PLN}}>Planificación</option>
        </select>
        <br/>
        <br/>
    <label for="invPrdPadre">Padre: </label>
    <input type="number" {{readonly}} name="invPrdPadre" value="{{invPrdPadre}}" maxlength="45" placeholder="Padre"/>
    </section>
    <br/>
    <section>
        <label for="invPrdFactor">Factor: </label>
        <input type="number" {{readonly}} name="invPrdFactor" value="{{invPrdFactor}}" maxlength="45" placeholder="Factor"/>
        <br/>
        <br/>
        <label for="invPrdVnd">VND: </label>
        <input type="text" {{readonly}} name="invPrdVnd" value="{{invPrdVnd}}" maxlength="3" placeholder="VND"/>
    </section>
    {{if hasErrors}}
        <section>
        <ul>
            {{foreach aErrors}}
                <li>{{this}}</li>
            {{endfor aErrors}}
        </ul>
        </section>
    {{endif hasErrors}}
    <section>
        {{if showaction}}
        <button type="submit" name="btnGuardar" value="G">Guardar</button>
        {{endif showaction}}
        <button type="button" id="btnCancelar">Cancelar</button>
    </section>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function(){
      document.getElementById("btnCancelar").addEventListener("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_productos");
      });
  });
</script>