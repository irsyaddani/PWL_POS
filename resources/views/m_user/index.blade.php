@extends('m_user.template')
@section('content')
    <div class="row mb-5 mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>CRUD user</h2>
            </div>
            <div class="float-right">
                <a href="{{ route('m_user.create') }}" class="btn btn-success">Input User</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table-hover table-striped table-bordered table">
        <thead>
            <tr>
                <th class="text-center">User id</th>
                <th class="text-center">Level id</th>
                <th class="text-center">Level kode</th>
                <th class="text-center">Level nama</th>
                <th class="text-center">username</th>
                <th class="text-center">nama</th>
                <th class="text-center">password</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($useri as $m_user)
                <tr>
                    <td>{{ $m_user->user_id }}</td>
                    <td>{{ $m_user->level->level_id }}</td>
                    <td>{{ $m_user->level->level_kode }}</td>
                    <td>{{ $m_user->level->level_nama }}</td>
                    <td>{{ $m_user->username }}</td>
                    <td>{{ $m_user->nama }}</td>
                    <td>{{ Str::limit($m_user->password, 6) }}...</td>

                    <td class="text-center">
                        <form action="{{ route('m_user.destroy', $m_user->user_id) }}" method="post">
                            <a href="{{ route('m_user.show', $m_user->user_id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('m_user.edit', $m_user->user_id) }}" class="btn btn-primary btn-sm">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection