<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $name }}</title>
    <style>
        .background_gray {
            background-color: #e6e6e6;
        }

        .bold {
            font-weight: bold;
        }

        .border {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .full {
            width: 100%;
        }

        .h25 {
            height: 25px;
        }

        .h50 {
            height: 50px
        }

        .h150 {
            height: 150px;
        }

        .text_left {
            text-align: left;
        }

        .text_right {
            text-align: right;
        }

        .w400 {
            width: 400px;
        }

        .w500 {
            width: 300px;
        }
    </style>
</head>

<body>
    <table class="full">
        <tr>
            <th class="text_left" colspan="2">Pemesanan Jaket Lab</th>
            <th class="text_right">RECEIPT</th>
        </tr>
        <tr>
            <th colspan="2" class="h150"></th>
            <th class="text_right">Laboratorium Informatika UMM</th>
        </tr>
        <tr>
            <th class="text_left w400">Bill To</th>
            <th class="text_right">Receipt #</th>
            <td class="text_right">{{ $transaction->id }}</td>
        </tr>
        <tr>
            <td>{{ $user_name }}</td>
            <th class="text_right">Receipt Date</th>
            <td class="text_right">14/07/2022</td>
        </tr>
        <tr>
            <td>{{ $full_name }}</td>
            <th class="text_right">Bank</th>
            <td class="text_right">{{ $bank->bank }}</td>
        </tr>
    </table>

    <br><br>

    <table class="border full">
        <tr class="background_gray border">
            <th class="border w500 h50" colspan="2">DESCRIPTION</th>
            <th class="border">AMOUNT</th>
        </tr>
        <!-- <tr style="height:200px"> -->
        <tr class="border">
            <td class="border h25" colspan="2">{{ $jacket->name }}</td>
            <td class="text_right border">{{ number_format($jacket->price, 2, ',', '.') }}</td>
        </tr>
        <tr class="border">
            <!-- <td class="border h25" colspan="2">Custom Size</td>
            <td class="text_right border">35.000,00</td> -->
            @if ($custom['a'] > 80 || ($custom['b'] > 80) | ($custom['c'] > 80))
                <td class="border h25" colspan="2">Custom Size</td>
                <td class="text_right border">35.000,00</td>
            @elseif ($custom['a'] < 80 || ($custom['b'] < 80) | ($custom['c'] < 80))
                <td class="border h25" colspan="2">Custom Size</td>
                <td class="text_right border">0,00</td>
            @else
                <td class="border h25" colspan="2">{{ $size->name }} Size</td>
                <td class="text_right border">0,00</td>
            @endif
        </tr>
        <tr>
            <td></td>
            <th class="text_right h50">TOTAL</th>
            <th class="background_gray border text_right">Rp{{ number_format($transaction->price, 2, ',', '.') }}</th>
        </tr>
    </table>

    <br><br><br>
    <br><br><br>

    <p class="bold">STATUS</p>
    <p>Paid</p>
</body>

</html>
