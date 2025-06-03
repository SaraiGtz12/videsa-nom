<!DOCTYPE html>
<html>
<head>
    <title>Normas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Selecciona una norma</h2>

<select id="normaSelect">
    <option value="">-- Elige --</option>
    <option value="085MG">085MG</option>
    <option value="085G">085G</option>
    <option value="085L">085L</option>
    <option value="085ML">085ML</option>
</select>

<div id="formularioNorma"></div>

<hr>

<h3>Resultados</h3>
<div id="tablaNorma"></div>

<script src="<?= base_url('assets/js/norma85.js') ?>"></script>
</body>
</html>
