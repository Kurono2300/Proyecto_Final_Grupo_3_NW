<h1>{{mode_dsc}}</h1>
<section>
  <form action="index.php?page=mnt_usuario&mode={{mode}}&usercod={{usercod}}"
    method="POST" >
    <section>
    <label for="usercod">Codigo: </label>
    <input type="hidden" id="usercod" name="usercod" value="{{usercod}}"/>
    <input type="text" readonly name="usercoddummy" value="{{usercod}}"/>
    </section>
    <br/>
    <section>
        <label for="useremail">Email: </label>
        <input type="text" {{readonly}} name="useremail" value="{{useremail}}" maxlength="45" placeholder="Correo"/>
        <br/>
        <br/>
        <label for="username">Username: </label>
        <input type="text" {{readonly}} name="username" value="{{username}}" maxlength="45" placeholder="Username"/>
        <br/>
        <br/>
        <label for="userpswd">Contraseña: </label>
        <input type="password" {{readonly}} name="userpswd" value="{{userpswd}}" maxlength="45" placeholder="Contraseña"/>
        <br/>
        <br/>
        <label for="userfching">Fecha: </label>
        <input type="Date" {{readonly}} name="userfching" value="{{userfching}}" maxlength="3" placeholder="Fecha:"/>
        <br/>
        <br/>
        <label for="userpswdest">Estado Password: </label>
        <select id="userpswdest" name="userpswdest" {{if readonly}}disabled{{endif readonly}}>
            <option value="ACT" {{userpswdest_ACT}}>Activo</option>
            <option value="INA" {{userpswdest_INA}}>Inactivo</option>
        </select>
        <br/>
        <br/>
    <label for="userpswdexp">Expiracion Password?: </label>
    <input type="Date" {{readonly}} name="userpswdexp" value="{{userpswdexp}}" maxlength="45" placeholder="Exp:"/>
    </section>
    <br/>
    <section>
    <label for="userest">Estado Usuario: </label>
    <select id="userest" name="userest" {{if readonly}}disabled{{endif readonly}}>
    <option value="ACT" {{userest_ACT}}>Activo</option>
    <option value="INA" {{userest_INA}}>Inactivo</option>
    <option value="BLQ" {{userest_BLQ}}>Bloqueado</option>
    <option value="SUS" {{userest_SUS}}>Suspendido</option>
    </select>
    </section>
    <br/>
    <section>
        <label for="useractcod">Codigo Activacion?: </label>
        <input type="password" {{readonly}} name="useractcod" value="{{useractcod}}" maxlength="45" placeholder="Factor"/>
        <br/>
        <br/>
        <label for="userpswdchg">Fecha Cambio Password: </label>
        <input type="Date" {{readonly}} name="userpswdchg" value="{{userpswdchg}}" maxlength="3" placeholder="PSW Change"/>
    </section>
    <br/>
    <br/>
    <section>
    <label for="usertipo">Tipo Usuario: </label>
        <select id="usertipo" name="usertipo" {{if readonly}}disabled{{endif readonly}}>
            <option value="PBL" {{usertipo_PBL}}>Publico</option>
            <option value="ADM" {{usertipo_ADM}}>Administrador</option>
            <option value="AUD" {{usertipo_AUD}}>Auditor</option>
        </select>
    </section>
    <br/>
    <br/>
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
        window.location.assign("index.php?page=mnt_usuarios");
      });
  });
</script>