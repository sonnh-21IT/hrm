@extends('layout.master')

@section('title')
    <h4 class="page-title pull-left">
        Projects</h4>
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

        function onUpdate(event, url, jsonData, people) {
            event.preventDefault()
            var form = document.getElementById('update-form')
            var inputCode = form.querySelector('input[name="code"]')
            var inputName = form.querySelector('input[name="name"]')
            var inputDesc = form.querySelector('textarea[name="description"]')
            var inputPeopleId = form.querySelectorAll('input[name="people[]"]');
            var selectCompanyId = form.querySelector('#companies')
            var count = 0;
            var colPerson = form.querySelector('#col-person')

            var data = JSON.parse(jsonData)
            inputName.value = data.name
            inputCode.value = data.code
            if (data.description != null) {
                inputDesc.value = data.description
            }

            if (data.company != null) {
                selectCompanyId.value = project.company_id;
            }

            var valueCompanyId = selectCompanyId.value

            people = JSON.parse(people)

            inputPeopleId.forEach(person => {
                person.checked = false;
            })

            if (people != null) {
                inputPeopleId.forEach(checkbox => {
                    people.forEach(person => {
                        var rowPerson = form.querySelector('#row-person-' + checkbox.value)
                        if (checkbox.getAttribute('data-company-id') != null && checkbox.getAttribute(
                                'data-company-id') == person.company_id) {
                            if (checkbox.value == person.id) {
                                checkbox.checked = true
                                count++;
                            } else {
                                checkbox.checked = false
                            }
                        }
                        if (valueCompanyId == checkbox.getAttribute('data-company-id')) {
                            rowPerson.style.display = 'block'
                        } else {
                            rowPerson.style.display = 'none'
                        }
                    })
                })
                if (count > 0) {
                    colPerson.style.display = 'block'
                } else {
                    colPerson.style.display = 'none'
                }
            }

            selectCompanyId.addEventListener('change', function() {
                var companyId = this.value
                var personIdCheckBoxs = form.querySelectorAll('input[name="people[]"]')
                var colPerson = form.querySelector('#col-person')
                var count = 0
                personIdCheckBoxs.forEach(checkbox => {
                    var rowPerson = form.querySelector('#row-person-' + checkbox.value)
                    if (checkbox.getAttribute('data-company-id') === companyId) {
                        rowPerson.style.display = 'block'
                        count++;
                    } else {
                        rowPerson.style.display = 'none'
                    }
                });
                if (count > 0) {
                    colPerson.style.display = 'block'
                } else {
                    colPerson.style.display = 'none'
                }
            })

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
                                        <th scope="col">Code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Công ty</th>
                                        <th scope="col">Người tham gia</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($projects)
                                        @if ($projects->count() > 0)
                                            @foreach ($projects as $project)
                                                <tr>
                                                    <th scope="row">{{ $project->id }}</th>
                                                    <td>
                                                        {{ $project->code }}
                                                    </td>
                                                    <td>
                                                        {{ $project->name }}
                                                    </td>
                                                    <td>
                                                        @isset($project->company)
                                                            {{ $project->company->name }}
                                                        @endisset
                                                    </td>
                                                    <td>
                                                        @isset($project->people)
                                                            @if ($project->people->count() > 0)
                                                                @foreach ($project->people as $person)
                                                                    {{ $person->full_name }}<br>
                                                                @endforeach
                                                            @endif
                                                        @endisset
                                                    </td>
                                                    <td>none</td>
                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a href="#" class="text-secondary"><i
                                                                        class="fa fa-edit"
                                                                        onclick="onUpdate(event,'{{ route('project.update', ['project' => $project->id]) }}','{{ $project }}','{{ $project->people }}')"></i></a>
                                                            </li>
                                                            <li><a href="#" class="text-danger"
                                                                    onclick="onDelete(event,'{{ route('project.destroy', ['project' => $project->id]) }}')"><i
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
        @isset($projects)
            @if ($projects->count() > 0)
                <div class="pagination justify-content-center">
                    {{ $projects->links('pagination::bootstrap-4') }}
                </div>
            @endif
        @endisset
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="" id="add-form">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm mới</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="code">Mã dự án</label>
                                    <input name="code" type="text" class="form-control" id="code"
                                        placeholder="Ví dụ: PR01, PR02, ...">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên dự án</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Ví dụ: Website bán hàng, Website quản lý nhân sự, ...">
                                </div>
                            </div>
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
                                    @isset($people)
                                        @if ($people->count() > 0)
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="form-label">Tham gia</label>
                                                        <div class="row">
                                                            <div class="col" style="height: 90px; overflow: auto">
                                                                @foreach ($people as $person)
                                                                    <div class="custom-control custom-checkbox"
                                                                        id="row-person-{{ $person->id }}">
                                                                        <input type="checkbox" name="people[]"
                                                                            class="custom-control-input"
                                                                            value="{{ $person->id }}"
                                                                            id="cd-role-{{ $person->id }}">
                                                                        <label class="custom-control-label"
                                                                            for="cd-role-{{ $person->id }}">{{ $person->full_name }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                @endif
                            @endisset
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
                        <h5 class="modal-title">Thêm mới</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="code">Mã dự án</label>
                                    <input name="code" type="text" class="form-control" id="code"
                                        placeholder="Ví dụ: PR01, PR02, ...">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên dự án</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Ví dụ: Website bán hàng, Website quản lý nhân sự, ...">
                                </div>
                            </div>
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
                                    @isset($people)
                                        @if ($people->count() > 0)
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <div class="col" id="col-person">
                                                        <label class="form-label">Tham gia</label>
                                                        <div class="row">
                                                            <div class="col" style="height: 90px; overflow: auto">
                                                                @foreach ($people as $person)
                                                                    <div class="custom-control custom-checkbox"
                                                                        id="row-person-{{ $person->id }}">
                                                                        <input type="checkbox" name="people[]"
                                                                            @isset($person->company) data-company-id="{{ $person->company->id }}" @endisset
                                                                            class="custom-control-input"
                                                                            value="{{ $person->id }}"
                                                                            id="cd-update-role-{{ $person->id }}">
                                                                        <label class="custom-control-label"
                                                                            for="cd-update-role-{{ $person->id }}">{{ $person->full_name }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                @endif
                            @endisset
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
