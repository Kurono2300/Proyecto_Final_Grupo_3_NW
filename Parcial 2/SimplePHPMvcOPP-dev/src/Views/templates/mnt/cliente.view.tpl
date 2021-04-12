<h1>{{mode_dsc}}</h1>
<section>
  <form action="index.php?page=mnt_cliente&mode={{mode}}&clientid={{clientid}}"
    method="POST" >
    <section>
    <label for="clientid">Id: </label>
    <input type="hidden" id="clientid" name="clientid" value="{{clientid}}"/>
    <input type="text" readonly name="clientiddummy" value="{{clientid}}"/>
    </section>
    <br/>
    <section>
      <label for="clientname">Nombre Completo: </label>
      <input type="text" {{readonly}} name="clientname" value="{{clientname}}" maxlength="45" placeholder="Nombre del Cliente"/>
      <br/>
      <br/>
      <label for="clientgender">Sexo: </label>
      <select id="clientgender" name="clientgender" {{if readonly}}disabled{{endif readonly}}>
        <option value="MAS" {{clientgender_M}}>Masculino</option>
        <option value="FEM" {{clientgender_F}}>Femenino</option>
      </select>

      <br/>
      <br/>
      <label for="clientphone1">Telefono Principal: </label>
      <input type="text" {{readonly}} name="clientphone1" value="{{clientphone1}}" maxlength="45" placeholder="Telefono #1"/>
      <br/>
      <br/>
      <label for="clientphone2">Telefono Secundario: </label>
      <input type="text" {{readonly}} name="clientphone2" value="{{clientphone2}}" maxlength="45" placeholder="Telefono #2"/>
      <br/>
      <br/>
      <label for="clientemail">Correo Electronico: </label>
      <input type="text" {{readonly}} name="clientemail" value="{{clientemail}}" maxlength="45" placeholder="Correo Electronico"/>
      <br/>
      <br/>
      <label for="clientIdnumber">Identidad: </label>
      <input type="text" {{readonly}} name="clientIdnumber" value="{{clientIdnumber}}" maxlength="45" placeholder="Numero de Identidad"/>
      <br/>
      <br/>
      <label for="clientbio">Biografia: </label>
      <input type="text" {{readonly}} name="clientbio" value="{{clientbio}}" maxlength="45" placeholder="Descripcion breve del cliente"/>
    </section>
    <br/>
    <section>
      <label for="clientstatus">Estado: </label>
      <select id="clientstatus" name="clientstatus" {{if readonly}}disabled{{endif readonly}}>
        <option value="ACT" {{clientstatus_ACT}}>Activo</option>
        <option value="INA" {{clientstatus_INA}}>Inactivo</option>
        <option value="PLN" {{clientstatus_PLN}}>Planificación</option>
      </select>
        <br/>
        <br/>
        <label for="clientdatecrt">Fecha Creacion: </label>
        <input type="date" {{readonly}} name="clientdatecrt" value="{{clientdatecrt}}" maxlength="45" placeholder="Año-Mes-Dia"/>
        <br/>
        <br/>
        <label for="clientusercreates">Creacion: </label>
        <input type="number" {{readonly}} name="clientusercreates" value="{{clientusercreates}}" maxlength="45" placeholder="Nivel De Acceso?"/>
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
        window.location.assign("index.php?page=mnt_clientes");
      });
  });
</script>
