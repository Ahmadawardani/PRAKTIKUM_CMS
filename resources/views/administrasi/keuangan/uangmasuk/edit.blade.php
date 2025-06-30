@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Uang Masuk</h3>
    <form method="POST" action="{{ route('uangmasuk.update', $uangMasuk->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $uangMasuk->tanggal }}" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $uangMasuk->jumlah }}" required>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="{{ $uangMasuk->keterangan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
