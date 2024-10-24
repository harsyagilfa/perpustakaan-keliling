@extends('admin.layouts.app')
@section('title','Data Member')
@section('content')
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
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->username }}</td>
                <td>
                    <span class="badge {{ $member->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                        {{ ucfirst($member->status) }}
                    </span>
                </td>
                <td>
                    @if($member->status == 'inactive')
                        <form action="{{ route('members.activate', $member->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Aktifkan</button>
                        </form>
                    @else
                        <span class="btn btn-secondary disabled">Sudah Aktif</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
