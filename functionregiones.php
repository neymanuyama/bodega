<?php
if (!class_exists("connection")) {
  include("conexion.php");
}
//variables POST
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
$metodo = isset($_POST['metodo']) ? $_POST['metodo'] : "";

$descripcionregion= isset($_POST['descripcionregion']) ? $_POST['descripcionregion'] : "";

//filtro




class regiones extends connection
{


  public function regionesSelect()
  {
    //consulta todos los empleados
    $sql = mysqli_query($this->open(), "SELECT * FROM regiones;");
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">


              <div class="card-header">
                <h3 class="card-title">Tabla de regiones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Modificar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($sql)) {
                      echo "<tr>";
                      $regionesid = $row[0];
                      echo "<td>" . $row[0] . "</td>";
                      echo "<td>" . $row[1] . "</td>";
                    ?>
                      <!-- Button trigger modal -->
                      <td><button type="button" class="btn btn-primary note-icon-pencil" data-toggle="modal" data-target="#exampleModal" onclick="regionesSelectOne('<?php echo $regionesid ?>'); regionesEditar();  return false"></button></td>
                      <!-- <button class="note-icon-pencil" ></button> -->
                      <td><button class="btn btn-danger note-icon-trash" onclick="regionesDelete('<?php echo $regionesid ?>');  return false"></button></td>
                    <?php
                      echo "</tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

  <?php
  }
  public function regionesDelete($codigo)
  {
    //registra los datos del empleados
    $sql = "DELETE FROM regiones where IdRegion='$codigo';";
    if (mysqli_query($this->open(), $sql)) {
    } else {
    }
    $this->regionesSelect();
  }
  public function regionesInsert($descripcionregion)
  {
    //registra los datos del regiones
    $sql = "INSERT INTO regiones (descripcionregion) VALUES ('$descripcionregion')";
    mysqli_query($this->open(), $sql) or die('Error. ' . mysqli_error($sql));
    $this->regionesSelect();
  }


  public function regionesSelectOne($codigo)
  {
    $sql = mysqli_query($this->open(), "select * from regiones where IdRegion ='$codigo'");
    $r = mysqli_fetch_assoc($sql);
    $codigo = $r["IdRegion"];
    $descripcionregion = $r["DescripcionRegion"];
    echo "<script>
      regiones.codigo.value='$codigo';
      regiones.descripcionregion.value='$descripcionregion';
      </script>";
    $this->regionesSelect();
  }
  public function regionesUpdate($codigo, $descripcionregion)
  {
    $sql = "UPDATE regiones set descripcionregion='$descripcionregion'  where IdRegion='$codigo'";
    mysqli_query($this->open(), $sql) or die('Error. ' . mysqli_error($sql));
    echo "<script>	
    regiones.codigo.value='$codigo';
    regiones.descripcionregion.value='$descripcionregion';
        </script>";
    $this->regionesSelect();
  }
  public function regionesSearch2()
  {
    $query = "SELECT nombreproducto from regiones";
    //consulta todos los regiones
    $sql = mysqli_query($this->open(), $query);

    while ($row = mysqli_fetch_array($sql)) {

      $nombre = $row[0];
    ?>
      <script>
        countries.push("<?php echo $nombre ?>");
      </script>
<?php
    }
  }
}

$regiones = new regiones();
if ($metodo == "delete") {
  $regiones->regionesDelete($codigo);
} elseif ($metodo == "insert") {
  $regiones->regionesInsert($descripcionregion);
} elseif ($metodo == "select") {
  $regiones->regionesSelectOne($codigo);
} elseif ($metodo == "update") {
  $regiones->regionesUpdate($codigo, $descripcionregion);
}