@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Divisi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('divisi.update', $divisi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_divisi">Nama Divisi</label>
            <input type="text" name="nama_divisi" class="form-control" value="{{ $divisi->nama_divisi }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
