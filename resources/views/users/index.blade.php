@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'user'
])

@section('content')
    <div class="content">
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Users') }}</h3>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('Email') }}</th>
                                        <th scope="col">{{ __('Creation Date') }}</th>
                                        <th scope="col">{{ __('Role') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                            </td>
                                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if ($user->type == 'super_admin')
                                                <span class="badge badge-pill badge-primary">Administrateur</span>
                                                @elseif ($user->type == 'user')
                                                <span class="badge badge-pill badge-secondary">Utilisateur</span>
                                                @else
                                                <span class="badge badge-pill badge-light">En Attente</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="nc-align-left-2 nc-icon"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        @if ($user->id != auth()->id())
                                                            <form action="{{ route('user.destroy', $user) }}" method="post">
                                                                @csrf
                                                                @method('delete')

                                                                <a class="dropdown-item" href="{{ route('user.edit', $user) }}">{{ __('Edit') }}</a>
                                                                <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            </form>
                                                        @else
                                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Edit') }}</a>
                                                        @endif
                                                        @if ($user->type == 'pending')
                                                        {{-- <button class="dropdown-item" onclick="Swal.fire({
                                                            title: '<strong>HTML <u>example</u></strong>',
                                                            type: 'info',
                                                            html:
                                                              'You can use <b>bold text</b>, ' +
                                                              '<a href='{{ route('user.approuve', $user->id) }}'>links</a> ' +
                                                            showCloseButton: true,
                                                            showCancelButton: true,
                                                            focusConfirm: false,
                                                            confirmButtonText:
                                                              '<i class='fa fa-thumbs-up'></i> Great!',
                                                            confirmButtonAriaLabel: 'Thumbs up, great!',
                                                            cancelButtonText:
                                                              '<i class='fa fa-thumbs-down'></i>',
                                                            cancelButtonAriaLabel: 'Thumbs down'
                                                          })" />{{ __('Approuve') }}</button> --}}
                                                          <form action="{{ route('user.approuve', $user->id) }}" method="get">
                                                          <button class="dropdown-item" type="submit" name="archive" onclick="archiveFunction()">
                                                                {{ __('Approuve') }}
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(count($users) > 15)
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                {{ $users->links() }}
                            </nav>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
function archiveFunction() {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
        swal({
  title: "Vous etes sure?",
  text: "D'approuver cet utilisateur.",
  type: "info",
  showCancelButton: true,
  confirmButtonText: "Oui",
  cancelButtonText: "Non",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
    swal("Success", "Proccess is successfully Done", "success");
    form.submit();         // submitting the form when user press yes
  } else {
    swal("Cancelled", "Proccess is cancelled", "error");
  }
});
}
    </script>
    @endpush

    @push('style')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    @endpush
    @endsection
