<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe PDF</title>
</head>
<body>
    <main>
        <?php $this->load->view('pdf/recursos/headerCaratula'); ?>

        <table class="info-table">
            <tr>
                <td class="col-1">
                    Carretera Jilotepec–Soyaniquilpan Km 3.5 MZ 2 Lt 1B, Parque industrial Jilotepec,<br>
                    Jilotepec, Estado de México, C.P. 54240<br>
                    Resto de país (Rp)
                </td>
                <td class="col-2">
                    Número de informe:<br>
                    Orden de servicio:<br>
                    Fecha de evaluación:<br>
                    Recepción:<br>
                    Fecha de informe:
                </td>
                <td class="col-3">
                    <?= $numero_informe ?><br>
                    <?= $orden_servicio ?><br>
                    <?= $fecha_evaluacion ?><br>
                    <?= $recepcion ?><br>
                    <?= $fecha_informe ?>
                </td>
                <td class="col-4">
                    <div class="placeholder-image">QR</div>
                </td>
            </tr>
        </table>

        <?php $this->load->view('pdf/recursos/footerCaratula'); ?>
    </main>
</body>
</html>
