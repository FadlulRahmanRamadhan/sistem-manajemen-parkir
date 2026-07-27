<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Riwayat Parkir</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: #fff;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px double #4f46e5;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 24px;
            color: #1e293b;
            letter-spacing: 1px;
        }
        .header p {
            font-size: 14px;
            color: #64748b;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 10px;
        }
        th {
            background: #4f46e5;
            color: white;
            font-weight: 600;
            padding: 10px 8px;
            border: 1px solid #4f46e5;
        }
        td {
            padding: 8px;
            border: 1px solid #cbd5e1;
            text-align: center;
        }
        tr:nth-child(even) {
            background: #f8fafc;
        }
        tr:hover {
            background: #eef2ff;
        }
        .footer {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            border-top: 1px solid #cbd5e1;
            padding-top: 15px;
        }
        .total {
            font-weight: bold;
            color: #4f46e5;
            font-size: 15px;
        }
        .text-right {
            text-align: right;
        }
        .badge {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        @media print {
            .no-print { display: none; }
            body { padding: 10px; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>🚗 LAPORAN RIWAYAT PARKIR</h1>
        <p>Periode: {{ now()->format('d F Y') }} | Total Data: {{ $riwayat->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:5%;">No</th>
                <th style="width:18%;">Plat Nomor</th>
                <th style="width:18%;">Pemilik</th>
                <th style="width:16%;">Waktu Masuk</th>
                <th style="width:16%;">Waktu Keluar</th>
                <th style="width:12%;">Durasi</th>
                <th style="width:15%;">Tarif</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayat as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $item->vehicle->plat_nomor }}</strong></td>
                    <td>{{ $item->vehicle->nama_pemilik }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->waktu_masuk)->format('d/m/Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->waktu_keluar)->format('d/m/Y H:i') }}</td>
                    <td>
                        <span class="badge">{{ $item->durasi }} jam</span>
                    </td>
                    <td><strong>Rp {{ number_format($item->tarif, 0, ',', '.') }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:20px; color:#94a3b8;">
                        Belum ada data riwayat parkir.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div>
            <span>Dicetak oleh: {{ Auth::user()->name ?? 'Admin' }}</span>
        </div>
        <div class="text-right">
            <span>Total Pendapatan: </span>
            <span class="total">Rp {{ number_format($riwayat->sum('tarif'), 0, ',', '.') }}</span>
        </div>
    </div>

    <div style="text-align:center; font-size:11px; color:#94a3b8; margin-top:20px; border-top:1px solid #e2e8f0; padding-top:10px;">
        &copy; {{ date('Y') }} Sistem Parkir - Laporan dibuat otomatis oleh sistem.
    </div>

</body>
</html>