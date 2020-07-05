<?php
if (!class_exists("connection")) {
  include("conexion.php");
}
//variables POST
$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
$metodo = isset($_POST['metodo']) ? $_POST['metodo'] : "";

$descripcionterritorio = isset($_POST['descripcionterritorio']) ? $_POST['descripcionterritorio'] : "";
$region = isset($_POST['region']) ? $_POST['region'] : "";
//filtro




class territorios extends connection
{


  public function territoriosSelect()
  {
    //consulta todos los empleados
    $sql = mysqli_query($this->open(), "SELECT * from  territorios;");
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">


              <div class="card-header">
                <h3 class="card-title">Tabla de territorios</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Descripcion Territorio</th>
                      <th>Region</th>

                      <th>Modificar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($sql)) {
                      echo "<tr>";
                      $territoriosid = $row[0];
                      echo "<td>" . $row[0] . "</td>";
                      echo "<td>" . $row[1] . "</td>";
                      echo "<td>" . $row[2] . "</td>";
                    ?>
                      <!-- Button trigger modal -->
                      <td><button type="button" class="btn btn-primary note-icon-pencil" data-toggle="modal" data-target="#exampleModal" onclick="territoriosSelectOne('<?php echo $territoriosid ?>'); territoriosEditar();  return false"></button></td>
                      <!-- <button class="note-icon-pencil" ></button> -->
                      <td><button class="btn btn-danger note-icon-trash" onclick="territoriosDelete('<?php echo $territoriosid ?>');  return false"></button></td>
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
  public function territoriosDelete($codigo)
  {
    //registra los datos del empleados
    $sql = "DELETE FROM territorios where IdTerritorio='$codigo';";
    if (mysqli_query($this->open(), $sql)) {
    } else {
    }
    $this->territoriosSelect();
  }
  public function territoriosInsert($codigo,$descripcionterritorio, $region)
  {
    //registra los datos del territorios
    $sql = "INSERT INTO territorios (Idterritorio,DescripcionTerritorio,idRegion) VALUES ('$codigo','$descripcionterritorio','$region')";
    mysqli_query($this->open(), $sql) or die('Error. ' . mysqli_error($sql));
    $this->territoriosSelect();
  }
  public function territoriosSelectOne($codigo)
  {
    $sql = mysqli_query($this->open(), "SELECT t.IdTerritorio,t.DescripcionTerritorio,r.IdRegion from
    territorios t inner join regiones r on t.IdRegion=r.IdRegion where IdTerritorio ='$codigo'");
    $r = mysqli_fetch_assoc($sql);
    $codigo = $r["IdTerritorio"];
    $descripcionterritorio = $r["DescripcionTerritorio"];
    $region = $r["IdRegion"];
    echo "<script>
      territorios.codigo.value='$codigo';
      territorios.descripcionterritorio.value='$descripcionterritorio';
      territorios.region.value='$region';
      </script>";
    $this->territoriosSelect();
  }

  public function territoriosUpdate($codigo, $descripcionterritorio, $region)
  {
    $sql = "UPDATE territorios set descripcionterritorio='$descripcionterritorio' ,idregion='$region' where IdTerritorio='$codigo'";
    mysqli_query($this->open(), $sql) or die('Error. ' . mysqli_error($sql));
    echo "<script>	
    territorios.codigo.value='$codigo';
      territorios.descripcionterritorio.value='$descripcionterritorio';
      territorios.region.value='$region';
        </script>";
    $this->territoriosSelect();
  }
  public function territoriosSearch2()
  {
    $query = "SELECT territorios from territorios";
    //consulta todos los territorios
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

$territorios = new territorios();
if ($metodo == "delete") {
  $territorios->territoriosDelete($codigo);
} elseif ($metodo == "insert") {
  $territorios->territoriosInsert($codigo,$descripcionterritorio, $region);
} elseif ($metodo == "select") {
  $territorios->territoriosSelectOne($codigo);
} elseif ($metodo == "update") {
  $territorios->territoriosUpdate($codigo, $descripcionterritorio, $region);
}