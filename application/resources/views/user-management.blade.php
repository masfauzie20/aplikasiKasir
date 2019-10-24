@extends('layouts.app')

@section('content')
    <!--begin::Card View -->
    <div class="card">
        <div class="card-header">
            <h4>Admin List</h4>
        </div>
        <table class="table table-md table-hover table-compact">
            <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Username</th>
                <th scope="col">Fullname</th>
                <th scope="col">Role</th>
                <th scope="col">Last Sign In</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($user_list as $kode => $user)
                <tr>
                    <th class="v-middle" scope="row">{{ $loop->iteration }}</th>
                    <td class="v-middle text-small">{{ $user->username }}</td>
                    <td class="v-middle text-small">{{ $user->name }}</td>
                    <td class="v-middle">{{ $user->role }}</td>
                    <td class="v-middle">{{\Carbon\Carbon::parse($user->last_login)->diffForHumans()}}</td>
                    <td class="v-middle">
                        <div class="btn-group">
                            <form action="{{ route('dashboard.user-management.delete', [$user->id]) }}"
                                  method="post">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button class="btn btn-sm btn-danger" type="submit"
                                        onclick="return confirm('Yakin ingin menghapus data ?')"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <div class="col-md-12 col-xs-12" style="margin-top: 16px;">
                <div class="float-right">
                    {{ $user_list }}
                </div>
            </div>
        </table>
    </div>
    <!--end::Card View -->
@endsection
