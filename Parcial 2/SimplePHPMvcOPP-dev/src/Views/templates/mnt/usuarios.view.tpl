<h1>Gestión de usuarios</h1>
<section class="WWFilter">

</section>
<section class="WWList">
  <table>
    <thead>
      <tr>
        <th>User Cod</th>
        <th>Email</th>
        <th>Username</th>
        <th>Password</th>
        <th>Fching</th>
        <th>Psw Dest</th>
        <th>Psw Dexp</th>
        <th>Estado</th>
        <th>Act Cod</th>
        <th>Psw Change</th>
        <th>Tipo</th>
        <!-- <th><button id="btnAdd">Nuevo</button></th> -->
      </tr>
    </thead>
    <tbody>
      {{foreach items}}
      <tr>
        <td>{{usercod}}</td>
        <td><a href="index.php?page=mnt_usuario&mode=DSP&usercod={{usercod}}">{{useremail}}</a></td>
        <td>{{username}}</td>
        <td>{{userpswd}}</td>
        <td>{{userfching}}</td>
        <td>{{userpswdest}}</td>
        <td>{{userpswdexp}}</td>
        <td>{{userest}}</td>
        <td>{{useractcod}}</td>
        <td>{{userpswdchg}}</td>
        <td>{{usertipo}}</td>
        <td>
        <form action="index.php" method="get">
            <input type="hidden" name="page" value="mnt_usuario"/>
            <input type="hidden" name="mode" value="UPD" />
            <input type="hidden" name="usercod" value={{usercod}} />
            <!-- <button type="submit">Editar</button> -->
        </form>
        <form action="index.php" method="get">
            <input type="hidden" name="page" value="mnt_usuario"/>
            <input type="hidden" name="mode" value="DEL" />
            <input type="hidden" name="usercod" value={{usercod}} />
            <!-- <button type="submit">Eliminar</button> -->
        </form>
        </td>
      </tr>
      {{endfor items}}
    </tbody>
  </table>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function () {
      document.getElementById("btnAdd").addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=mnt_usuario&mode=INS&usercod=0");
      });
    });
</script>