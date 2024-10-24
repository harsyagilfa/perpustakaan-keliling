@extends('admin.layouts.app')
@section('title','Tambah Buku')
@section('content')
<div class="container">
    <form action="{{ route('tambah_buku_aksi') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Judul Buku</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="author">Pengarang</label>
            <input type="text" name="author" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="published_year">Tahun Terbit</label>
            <input type="number" name="publish_year" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="available">Available</option>
                <option value="empty">Empty</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
