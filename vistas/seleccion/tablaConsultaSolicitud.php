<?php
include("../../config/connection.php");

echo "<table class='table table-bordered table-responsive' style='width: 95%;'>
      <tr>
        <!--<td>ID</td>-->
        <td><b>Nombre</b></td>
        <td><b>Tipo Identificación</b></td>
        <td><b>Número Identificación</b></td>
        <td><b>Cargo</b></td>
        <td><b>Área</b></td>
        <td><b>Site</b></td>
        <td><b>Tipo Convocatoria</b></td>
      </tr>";
 ?>

      <?php
      $consulta = 'USE HR_Analytics; SELECT nombreEvaluado, tipoIdentificacion, numeroIdentificacion, cargoEvaluado, areaEvaluado, ciudadPeticion, tipoConvocatoria
      FROM solicitudPrevia_poli';

      $ejecutar = odbc_exec($connect, $consulta);

      $i = 0;

      while($fila =  odbc_fetch_array($ejecutar)){
        $nombreEvaluado = $fila['nombreEvaluado'];
        $tipoIdentificacion = $fila['tipoIdentificacion'];
        $numeroIdentificacion = $fila['numeroIdentificacion'];
        $cargoEvaluado = $fila['cargoEvaluado'];
        $areaEvaluado = $fila['areaEvaluado'];
        $ciudadPeticion = $fila['ciudadPeticion'];
        $tipoConvocatoria = $fila['tipoConvocatoria'];
        $i++;


        ?>

        <tr align='center'>
          <!--<td><?php //echo $id; ?></td>-->

          <td><?php echo utf8_encode($nombreEvaluado); ?></td>
          <td><?php echo utf8_encode($tipoIdentificacion); ?></td>
          <td><?php echo utf8_encode($numeroIdentificacion); ?></td>
          <td><?php echo utf8_encode($cargoEvaluado); ?></td>
          <td><?php echo utf8_encode($areaEvaluado); ?></td>
          <td><?php echo utf8_encode($ciudadPeticion); ?></td>
          <td><?php echo utf8_encode($tipoConvocatoria); ?></td>
          <td><a href='editarUsuarios.php?editar=<?php echo $id; ?>' class='editarUsuario'><i class='fa fa-pencil' aria-hidden='true'></i></a></td>
          <td><a href='editarUsuarios.php?borrar=<?php echo $id; ?>'><i class='fa fa-trash-o' aria-hidden='true'></i></a></td>
        </tr>

      <?php } ?>
      <br>
    </table>