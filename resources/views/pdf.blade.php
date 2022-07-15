<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .border {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }

        .full {
            width: 100%;
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

        .background_gray {
            background-color: #e6e6e6;
        }

        img {
            width: 100px;
        }
    </style>
</head>

<body>
    <table class="full">
        <tr>
            <th class="text_left" colspan="2">Pemesanan Jaket Lab</th>
            <th>RECEIPT</th>
        </tr>
        <tr>
            <th colspan="2" class="h150"></th>
            <!-- <th>LOGO</th> -->
            <!-- <th><img src="https://drive.google.com/file/d/1bU0xMTZV8s8hmZ_uK3wP2MY3XYgHklZU/view?usp=sharing" alt=""></th> -->
            <th><img src="{{ asset('storage/app/public/labitputih.png') }}" alt=""></th>
        </tr>
        <tr>
            <th class="text_left">Bill To</th>
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
            <td class="text_right">{{ $transaction->bank }}</td>
        </tr>
    </table>

    <br><br>

    <table class="border">
        <tr class="background_gray border">
            <th class="border" colspan="2">DESCRIPTION</th>
            <th class="border">AMOUNT</th>
        </tr>
        <!-- <tr style="height:200px"> -->
        <tr class="border">
            <td class="border" colspan="2">{{ $jacket->name }}</td>
            <td class="text_right border">{{ number_format($jacket->price,2,',','.') }}</td>
        </tr>
        <tr class="border">
            <td class="border" colspan="2">Custom Size</td>
            <td class="text_right border">35.000,00</td>
            <!-- @if ($transaction->custom == null)
                <td class="border" colspan="2">{{ $size->name }} Size</td>
                <td class="text_right border">0,00</td>
            @else
                <td class="border" colspan="2">Custom Size</td>
                <td class="text_right border">35.000,00</td>
            @endif -->
        </tr>
        <tr class="full">
            <td class="full"></td>
            <th class="text_right">TOTAL</th>
            <th class="background_gray border text_right">Rp{{ number_format($transaction->price,2,',','.') }}</th>
        </tr>
    </table>

    <br><br><br><br><br>
    <br><br><br><br><br>

    <h3>STATUS : Paid</h3>
</body>

</html>