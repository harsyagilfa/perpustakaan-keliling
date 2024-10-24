@extends('admin.layouts.app')
@section('title','Edit Data Buku')
@section('content')
<div class="container">
    <form action="{{ route('update_buku_aksi',$books->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $books->title }}" required>
        </div>
        <div class="form-group">
            <label for="author">Penulis</label>
            <input type="text" name="author" class="form-control" value="{{ $books->author }}" required>
        </div>
        <div class="form-group">
            <label for="published_year">Tahun Terbit</label>
            <input type="number" name="publish_year" class="form-control" value="{{ $books->publish_year }}" required>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" id="status" class="form-control">
                <option value="#">Pilih Status</option>
                <option value="available" {{ $books->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="empty" {{ $books->status == 'empty' ? 'selected' : '' }}>Empty</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
