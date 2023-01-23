@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('All Users') }}</div>
        <div class="card-body">
            @if ($users->count() > 0)
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{!! $user->name !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td>

                                    <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                        @csrf
                                        @if ($user->isAdmin())
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Demote to Writer
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-success">
                                                Promote to Admin
                                        @endif
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <div class="text-center">
                    <img src="{{ asset('media/no-data.png') }}" alt="" width="225px">
                    <h3>No Users Yet!</h3>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
@endsection
