@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Surat Keluar</h3>
    <form method="POST" action="{{ route('suratkeluar.update', $suratKeluar->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tujuan</label>
            <input type="text" name="tujuan" class="form-control" value="{{ $suratKeluar->tujuan }}" required>
        </div>
        <div class="mb-3">
            <label>Perihal</label>
            <input type="text" name="perihal" class="form-control" value="{{ $suratKeluar->perihal }}" required>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $suratKeluar->tanggal }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
