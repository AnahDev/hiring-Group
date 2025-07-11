<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Trabajo</title>
    <style>
        /* Estilos básicos para la impresión y visualización */
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.6;
            margin: 40px;
            color: #333;
            font-size: 12pt;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h2 {
            font-size: 18pt;
            text-transform: uppercase;
        }

        .content {
            margin-top: 30px;
            margin-bottom: 30px;
            text-align: justify;
        }

        .content p {
            text-indent: 50px;
        }

        /* Sangría en el primer párrafo */
        strong {
            font-weight: bold;
        }

        .date-city {
            text-align: right;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .signature {
            margin-top: 60px;
            text-align: center;
        }

        .signature p:first-child {
            margin-bottom: 5px;
        }

        /* Espacio entre línea y texto */
        .closing {
            margin-top: 30px;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                border: none;
                box-shadow: none;
                padding: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>A QUIEN PUEDA INTERESAR</h2>
        </div>

        <div class="content">
            <p>Por medio de la presente la empresa HIRING GROUP hace constar que el ciudadano(a)
                <strong>{{ $nombreCompleto }}</strong>, labora con nosotros desde el
                {{ $fechaInicioLabores }},
                cumpliendo funciones en el cargo de <strong>{{ $cargo }}</strong>
                en la empresa <strong>{{ $nombreEmpresa }}</strong>,
                devengando un salario mensual de
                <strong>{{ number_format($salarioMensual, 2, ',', '.') }}</strong>.
            </p>

            <p class="date-city">Constancia que se pide por la parte interesada en la ciudad de
                {{ $ciudad }} en fecha {{ $fechaConstancia }}.</p>
        </div>
        <div class="signature">
            <br><br>
            <p>____________________________________</p>
            <p>Firma y Sello de la Empresa</p>
            <p>Hiring Group</p>
            {{--     <p>R.I.F. J-12345678-9</p> {{-- Puedes añadir datos reales aquí --}}
        </div>
    </div>
</body>

</html>
