@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Anggota</h2>
    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nim">NIM</label>
            <input type="text" name="nim" class="form-control" value="{{ $anggota->nim }}">
        </div>

        <div class="mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $anggota->nama }}">
        </div>

        <div class="mb-3">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ $anggota->jabatan }}">
        </div>

        <div class="mb-3">
    <label for="divisi_id">Divisi</label>
    <select name="divisi_id" class="form-control">
        <option value="">-- Pilih Divisi --</option>
        @foreach($divisis as $divisi)
            <option value="{{ $divisi->id }}" {{ (old('divisi_id') == $divisi->id) ? 'selected' : '' }}>
                {{ $divisi->nama_divisi }}
            </option>
        @endforeach
    </select>
</div>


        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
