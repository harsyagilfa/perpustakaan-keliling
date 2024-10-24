@extends('admin.layouts.app')
@section('title','Data Buku')
@section('content')
<div class="container">
    <h1>Daftar Buku</h1>
    @if(session('alert'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <a href="{{ route('tambah_buku') }}" class="btn btn-primary">Tambah Buku</a>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Tahun Terbit</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->title }}</td>
                    <td>{{ $b->author }}</td>
                    <td>{{ $b->publish_year }}</td>
                    <td>{{ $b->status }}</td>
                    <td>
                        <a href="{{ route('update_buku', $b->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('delete_buku', $b->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
