@extends('member.layouts.app')
@section('title','Dashboard')
@section('content')
<div class="container-fluid">
    @if ($loans->isEmpty())
    <p>Tidak ada buku yang sedang dipinjam.</p>
@else
@if (session('alert'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@endif
@if(session('status'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<table class="table">
    <thead>
        <tr>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Tanggal Pinjam</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($loans as $l)
            <tr>
                <td>{{ $l->book->title }}</td>
                <td>{{ $l->book->author }}</td>
                <td>{{ $l->loan_date }}</td>
                <td>
                    <form action="{{ route('member.return', $l->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Kembalikan Buku</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
</div>
@endsection

