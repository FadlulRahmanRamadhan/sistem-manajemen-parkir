<!DOCTYPE html>
<html>
<head>
    <title>Laporan Parkir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background: #4f46e5;
            color: #fff;
        }
        .total {
            margin-top: 15px;
            text-align: right;
            font-weight: bold;
            font-size: 14px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Laporan Parkir</h2>
    <p><strong>Periode:</strong> 
        {{ request('tanggal_awal') ? date('d/m/Y', strtotime(request('tanggal_awal'))) : 'Semua' }} 
        - 
        {{ request('tanggal_akhir') ? date('d/m/Y', strtotime(request('tanggal_akhir'))) : 'Semua' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Plat Nomor</th>
                <th>Pemilik</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Durasi</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->vehicle->plat_nomor }}</td>
                    <td>{{ $item->vehicle->nama_pemilik }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->waktu_masuk)->format('d/m/Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->waktu_keluar)->format('d/m/Y H:i') }}</td>
                    <td>{{ $item->durasi }} jam</td>
                    <td>Rp {{ number_format($item->tarif, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
    </div>

    <div class="footer">
        Dicetak pada: {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>