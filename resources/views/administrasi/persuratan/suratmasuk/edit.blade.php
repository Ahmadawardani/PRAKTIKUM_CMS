@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Surat Masuk</h3>
    <form method="POST" action="{{ route('suratmasuk.update', $suratMasuk->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Pengirim</label>
            <input type="text" name="pengirim" class="form-control" value="{{ $suratMasuk->pengirim }}" required>
        </div>
        <div class="mb-3">
            <label>Perihal</label>
            <input type="text" name="perihal" class="form-control" value="{{ $suratMasuk->perihal }}" required>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $suratMasuk->tanggal }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
