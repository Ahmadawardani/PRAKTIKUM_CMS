@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Uang Keluar</h3>
    <form method="POST" action="{{ route('uangkeluar.update', $uangKeluar->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $uangKeluar->tanggal }}" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $uangKeluar->jumlah }}" required>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="{{ $uangKeluar->keterangan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
