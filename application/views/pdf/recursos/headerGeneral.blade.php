<table width="100%" style="border-collapse: collapse; margin-bottom: 10px;">
    <tr>
        <td style="width: 120px;">
            @if ($modo === 'pdf')
                <img style="width: 100px;" src="{{ public_path('img/logo.png') }}">
            @else       
                <img src="{{ asset('img/logo.png') }}" width="100">
            @endif
        </td>

        <td style="vertical-align: top;">
            <table style="font-size: 10px; border-collapse: collapse; width: 100%;">
                <tr>
                    <td style="padding: 5px; border: 1px solid #000;">
                        <strong>Título:</strong><br>
                        Hoja de campo para la determinación de Gases de combustión para equipos de calentamiento indirecto de capacidad térmica
                        mayor de 0.53 GJ/h o 15 C.C y hasta 5.3 GJ/h o 150 C.C. combustible gaseoso
                    </td>
                    <td style="padding: 5px; border: 1px solid #000;">
                        <strong>Código:</strong><br> FC-AAR-002
                    </td>
                    <td style="padding: 5px; border: 1px solid #000;">
                        <strong>Revisión:</strong><br> 23
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
