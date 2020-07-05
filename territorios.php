<?php
include("head.php");
include('functionterritorios.php');
?>



<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="page-header"><i class="fa fa-table"></i> territorios</h3>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Tabla</li>
                    <li class="breadcrumb-item active">territorios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="territoriosNuevo();">Agregar</button>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Gestionar territorios</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form accept-charset="utf-8" id="territorios" name="territorios" method="POST" action="" enctype="multipart/form-data">
                    <div class="col s12 l6">
                        Codigo <input name="codigo" type="text" class="form-control" />
                        Descripcion Territorio <input name="descripcionterritorio" type="text" class="form-control" />

                        <select name="region" id="region" class="form-control">
                            <?php
                            $con = new connection();
                            $sql = mysqli_query($con->open(), "SELECT IdRegion,DescripcionRegion from regiones");
                            while ($row = mysqli_fetch_array($sql)) {
                                $regionid = $row[0];
                                $nombre = $row[1];
                                echo "<option value='$regionid'>" .  $nombre . "</option>";
                            }

                            ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" name="nuevo" value="Nuevo" class="btn btn-secondary" onclick="territoriosNuevo(); return false" />

                <input type="button" name="btn" value="Grabar" class="btn btn-success" onclick="territoriosInsert();    territoriosNuevo(); return false" />

                <input type="submit" name="modificar" value="Modificar" class="btn btn-primary" onclick="territoriosUpdate(); return false" />
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<p></p>

</form>




<div id="resultado" class="container-fluid">


    <?php
    $territorios->territoriosSelect();

    ?>

</div>

<?php
include "footer.php";
?>