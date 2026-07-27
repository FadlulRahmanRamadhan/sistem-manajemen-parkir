<!DOCTYPE html>
<html>
<head>
    <title>Struk Parkir</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Courier New', monospace;
            font-size: 13px;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .struk {
            width: 300px;
            background: white;
            padding: 20px 20px 15px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        .logo {
            width: 60px;
            margin-bottom: 8px;
        }
        .judul {
            font-size: 22px;
            font-weight: bold;
            color: #1e293b;
            letter-spacing: 1px;
        }
        .subjudul {
            font-size: 11px;
            color: #94a3b8;
            margin-bottom: 10px;
        }
        hr {
            border: none;
            border-top: 2px dashed #cbd5e1;
            margin: 10px 0;
        }
        table {
            width: 100%;
            text-align: left;
            font-size: 13px;
        }
        td {
            padding: 4px 0;
        }
        .label {
            color: #64748b;
            width: 40%;
        }
        .value {
            font-weight: 600;
            color: #0f172a;
        }
        .barcode {
            font-size: 28px;
            letter-spacing: 4px;
            color: #1e293b;
            font-weight: bold;
            margin: 8px 0;
        }
        .footer {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 8px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
        .footer span {
            color: #3b82f6;
        }
    </style>
</head>
<body>

    <div class="struk">

        {{-- Logo --}}
        <img class="logo" src="{{ asset('logo.png') }}" alt="Logo">

        <div class="judul">🚗 SISTEM PARKIR</div>
        <div class="subjudul">Jl. Contoh No. 1 • Telp. (021) 1234567</div>

        <hr>

        {{-- Detail Parkir --}}
        <table>
            <tr>
                <td class="label">No. Tiket</td>
                <td class="value">: #{{ str_pad($parking->id, 5, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label">Plat Nomor</td>
                <td class="value">: {{ $parking->vehicle->plat_nomor }}</td>
            </tr>
            <tr>
                <td class="label">Jenis</td>
                <td class="value">: {{ $parking->vehicle->jenis_kendaraan }}</td>
            </tr>
            <tr>
                <td class="label">Tarif / Jam</td>
                <td class="value">:
                    Rp {{ number_format($parking->vehicle->jenis_kendaraan == 'Motor' ? 2000 : 5000, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td class="label">Tanggal</td>
                <td class="value">: {{ date('d/m/Y', strtotime($parking->waktu_masuk)) }}</td>
            </tr>
            <tr>
                <td class="label">Jam Masuk</td>
                <td class="value">: {{ date('H:i', strtotime($parking->waktu_masuk)) }}</td>
            </tr>
            <tr>
                <td class="label">Petugas</td>
                <td class="value">: {{ Auth::user()->name }}</td>
            </tr>
        </table>

        <hr>

        {{-- Barcode --}}
        <div class="barcode">||| {{ $parking->id }} |||</div>

        {{-- Footer --}}
        <div class="footer">
            <span>✦</span> Simpan struk ini <span>✦</span><br>
            Jangan hilangkan tiket ini<br>
            <span>✦</span> Terima kasih <span>✦</span>
        </div>

    </div>

</body>
</html>