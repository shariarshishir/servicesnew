@extends('layouts.admin')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
				<legend>Users List</legend>
                @if(count($users)>0)
                    <table class="table table-bordered users-table" >
                        <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td class="center">
                                        <a href="{{route('user.show', $user->id)}}">{{$user->email}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info" role="alert">INFO : No users available.</div>
                @endif
              </div>
              {{-- {{ $users->links() }} --}}
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

@endsection

@push('js')
  <script>
      $('.users-table').DataTable();
  </script>
@endpush
