<style>
     .top-section {
            text-align: left;
            @if ($modo === 'web')
            margin-top: 10px;
            @else
            margin-top: 10px;
            @endif
        }

        .logo {
            margin-bottom: 5px;
           
        }

        .title {
            font-size: 12px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 10px;
            text-align: left;
        }
        .subtitle {
            font-size: 9px;
            text-align: justify;
            margin-bottom: 20px;
        }
        .divider {
            border-top: 1px solid black;
            margin: 5px 0;
        }
</style>
<div class="top-section">

    <div class="logo">
        @if ($modo === 'pdf')
            <img style="width: 100px;" src="{{ public_path('img/logo.png') }}">
        @else       
           <img src="{{ asset('img/logo.png') }}" width="100">
        @endif
    </div>

    <div class="title">Informe de Resultados</div>        
</div>

    
        <div class="divider"></div>
   
        <div class="subtitle"> 
            Comparación con la Norma Oficial Mexicana NOM-085-SEMARNAT-2011, Contaminación atmosférica — Niveles máximos permisibles de emisión de los equipos de combustión de calentamiento indirecto y su medición.
            <br>
            Para equipos con capacidad térmica nominal mayor de 5.3 G/J o 150 C.C combustible gaseoso
        </div>