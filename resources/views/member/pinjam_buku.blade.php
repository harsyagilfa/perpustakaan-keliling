@extends('member.layouts.app')
@section('title','Pinjam Buku')
@section('content')
<div class="container">
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
                <th>Penulis</th>
                <th>Tahun Terbit</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->published_year }}</td>
                    <td>{{ ucfirst($book->status) }}</td>
                    <td>
                        @if($book->status == 'available')
                            <form action="{{ route('loan', $book->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Pinjam</button>
                            </form>
                        @else
                            <button class="btn btn-secondary" disabled>Empty</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
