@extends('layout.master')

@section('title')
    <h4 class="page-title pull-left">Countries</h4>
@endsection

@section('content')
    <script>
        function onDelete(event, url) {
            event.preventDefault()
            var form = document.getElementById('delete-form')

            form.action = url
            console.log(url)

            $('#modal-delete').modal('show');
        }

        function onUpdate(event, url, jsonData) {
            event.preventDefault()
            var form = document.getElementById('update-form')
            var inputFullName = form.querySelector('input[name="full_name"]')
            var inputEmail = form.querySelector('input[name="email"]')
            var inputPhoneNumber = form.querySelector('input[name="phone_number"]')
            var inputBirthdate = form.querySelector('input[name="birthdate"]')
            var inputAddress = form.querySelector('input[name="address"]')
            var inputGender = form.querySelectorAll('input[type="radio"][name="gender"]');
            var inputRole = form.querySelectorAll('input[type="checkbox"][name="roles[]"]');
            var selectCompany = form.querySelector("#companies");
            var optionCompany = selectCompany.options

            var data = JSON.parse(jsonData)
            inputFullName.value = data.person.full_name
            inputEmail.value = data.email
            inputAddress.value = data.person.address
            inputPhoneNumber.value = data.person.phone_number
            inputBirthdate.value = data.person.birthdate


            inputGender.forEach(element => {
                if (element.value == data.person.gender) {
                    element.checked = true
                }
            });

            inputRole.forEach(element => {
                data.roles.forEach(role => {
                    if (element.value == role.id) {
                        element.checked = true
                    }
                })
            })
            if (selectCompany != null) {
                Array.from(optionCompany).forEach(company => {
                    company.selected = true
                })
            }

            form.action = url
            $('#modal-update').modal('show');
        }
    </script>
    <div class="row">
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-12 my-2">
                            <div type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i
                                    class="fa-solid fa-plus mr-2"></i> Thêm mới</div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-12 my-2">
                            <div type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target=""><i
                                    class="fa-solid fa-download"></i> Tải xuống (excel)</div>
                        </div>
                        <div class="col-12">
                            @if ($errors->any())
                                <div class="alert-dismiss">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                class="fa fa-times"></span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert-dismiss">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                class="fa fa-times"></span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert-dismiss">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                class="fa fa-times"></span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone number</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Birthdate</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($people)
                                        @if ($people->count() > 0)
                                            @foreach ($people as $user)
                                                <tr>
                                                    <th scope="row">{{ $user->id }}</th>
                                                    <td>{{ $user->person->full_name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->person->phone_number }}</td>
                                                    <td>{{ $user->person->gender }}</td>
                                                    <td>{{ $user->person->birthdate }}</td>
                                                    <td>
                                                        @isset($user->roles)
                                                            @if ($user->roles->count() > 0)
                                                                @foreach ($user->roles as $role)
                                                                    {{ $role->role }}<br>
                                                                @endforeach
                                                            @endif
                                                        @endisset
                                                    <td>{{ $user->person->address }}</td>
                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a href="#" class="text-secondary"><i
                                                                        class="fa fa-edit"
                                                                        onclick="onUpdate(event,'{{ route('user.update', ['user' => $user->id]) }}','{{ $user }}')"></i></a>
                                                            </li>
                                                            <li><a href="#" class="text-danger"
                                                                    onclick="onDelete(event,'{{ route('user.destroy', ['user' => $user->id]) }}')"><i
                                                                        class="fa-solid fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @isset($people)
            @if ($people->count() > 0)
                <div class="pagination justify-content-center">
                    {{ $people->links('pagination::bootstrap-4') }}
                </div>
            @endif
        @endisset
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('user.store') }}" id="add-form">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm mới</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="example@gmail.com">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone_number" class="form-label">Telephone</label>
                                    <input class="form-control" type="tel" placeholder="+880-1233456789"
                                        id="phone_number" name="phone_number">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="full_name" class="col-form-label">Full name</label>
                                    <input class="form-control" type="text" placeholder="Carlos Rath" id="full_name"
                                        name="full_name">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="birthdate" class="col-form-label">Birthdate</label>
                                    <input class="form-control" type="date" placeholder="2018-03-05" id="birthdate"
                                        name="birthdate">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    @isset($companies)
                                        @if ($companies->count() > 0)
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Company</label>
                                                    <select class="custom-select" name="company_id" id="companies">
                                                        @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                    <div class="col-12">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" checked id="male" name="gender" value="Nam"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="male">Nam</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="female" name="gender" value="Nữ"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="female">Nữ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @isset($roles)
                                @if ($roles->count() > 0)
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group row">
                                            <div class="col">
                                                <label class="form-label">Roles</label>
                                                <div class="row">
                                                    <div class="col" style="height: 90px; overflow: auto">
                                                        @foreach ($roles as $role)
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="roles[]"
                                                                    class="custom-control-input" value="{{ $role->id }}"
                                                                    id="cd-role-{{ $role->id }}">
                                                                <label class="custom-control-label"
                                                                    for="cd-role-{{ $role->id }}">{{ $role->role }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endisset
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address" class="col-form-label">Address</label>
                                    <input class="form-control" type="text" id="address" name="address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-update">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="" id="update-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Cập nhật</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="example@gmail.com">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="phone_number" class="form-label">Telephone</label>
                                    <input class="form-control" type="tel" placeholder="+880-1233456789"
                                        id="phone_number" name="phone_number">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="full_name" class="form-label">Full name</label>
                                    <input class="form-control" type="text" placeholder="Carlos Rath" id="full_name"
                                        name="full_name">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="birthdate" class="form-label">Birthdate</label>
                                    <input class="form-control" type="date" placeholder="2018-03-05" id="birthdate"
                                        name="birthdate">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    @isset($companies)
                                        @if ($companies->count() > 0)
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Company</label>
                                                    <select class="custom-select" name="company_id" id="companies">
                                                        @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                    <div class="col-12">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" checked id="male" name="gender" value="Nam"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="male">Nam</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="female" name="gender" value="Nữ"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="female">Nữ</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @isset($roles)
                                @if ($roles->count() > 0)
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group row">
                                            <div class="col">
                                                <label class="form-label">Roles</label>
                                                <div class="row">
                                                    <div class="col" style="height: 90px; overflow: auto">
                                                        @foreach ($roles as $role)
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="roles[]"
                                                                    class="custom-control-input" value="{{ $role->id }}"
                                                                    id="cd-role-{{ $role->id }}">
                                                                <label class="custom-control-label"
                                                                    for="cd-role-1">{{ $role->role }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endisset
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address" class="col-form-label">Address</label>
                                    <input class="form-control" type="text" id="address" name="address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal delete --}}
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Xóa</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa một mục không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Xác nhận
                            xóa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
