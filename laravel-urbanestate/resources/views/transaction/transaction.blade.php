@extends('layouts.app')

@section('title')
    Transaksi | UrbanEstate Admin
@endsection
@section('content')
    <h3>Transaction</h3>
    <button type="button" class="btn btn-tambah">
        <a href="/transaksi/cetak">Cetak</a>
    </button>
    <table class="table-data">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->updated_at }}</td>
                    <td>{{ $transaction->nama }}</td>
                    <td>{{ $transaction->category->nama}}</td>
                    <td>Rp. {{ number_format($transaction->harga) }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td style='display: none;'>{{ $transaction->nomorhp }}</td>
                    <td>
                        <button class='btn_detail' data-nomorhp='{{ $transaction->nomorhp }}'
                            onclick='showDetails("{{ $transaction->tanggal }}", "{{ $transaction->nama }}", "{{ $transaction->category->nama}}", "{{ $transaction->harga }}", "{{ $transaction->status }}")'>Detail</button>
                    </td>
                @empty
                <tr>
                    <td colspan="6" align="center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
