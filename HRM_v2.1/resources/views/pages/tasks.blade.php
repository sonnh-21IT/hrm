@extends('layout.master')

@section('title')
    <div class="col-md-6 col-sm-12">
        <h4 class="page-title pull-left">Tasks</h4>
    </div>

    <form action="{{ route('task.search') }}" class="col-md-6 col-sm-12">
        <div class="input-group">
            <input type="search" class="form-control rounded" placeholder="Search by name" aria-label="Search"
                aria-describedby="search-addon" name="name"
                @isset($oldName)
                    value="{{ $oldName }}"
                @endisset />
            <button type="submit" class="btn btn-outline-primary pull-right" data-mdb-ripple-init>search</button>
        </div>
    </form>
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
            var inputName = form.querySelector('input[name="name"]')
            var inputStart = form.querySelector('input[name="start_time"]')
            var inputEnd = form.querySelector('input[name="end_time"]')
            var inputDesc = form.querySelector('textarea[name="description"]')
            var selectPerson = form.querySelector('#person')
            var optionPerson = selectPerson.options
            var selectProject = form.querySelector('#projects')
            var optionProject = selectProject.options
            var selectPriority = form.querySelector('#priority')
            var optionPriority = selectPriority.options
            var selectStatus = form.querySelector('#status')
            var optionStatus = selectStatus.options


            var data = JSON.parse(jsonData)
            inputName.value = data.name
            inputStart.value = data.start_time
            inputEnd.value = data.end_time
            inputDesc.value = data.description

            Array.from(optionProject).forEach(project => {
                if (project.value == data.project.id) {
                    project.selected = true;
                }
            });
            Array.from(optionPerson).forEach(person => {
                if (person.value == data.person.id) {
                    person.selected = true;
                }
            });
            Array.from(optionPriority).forEach(priority => {
                if (priority.value == data.priority) {
                    priority.selected = true;
                }
            });
            Array.from(optionStatus).forEach(status => {
                if (status.value == data.status) {
                    status.selected = true;
                }
            });

            form.action = url

            $('#modal-update').modal('show');
        }
    </script>
    <div class="row">
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('task.filter') }}" action="GET">
                                <div class="form-row align-items-center">
                                    <div class="col-auto my-1">
                                        <div class="form-group">
                                            <label class="form-label">Dự án</label>
                                            <select class="custom-select" name="project_id" id="projects">
                                                <option value="">-- chọn </option>
                                                @isset($projects)
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->id }}"
                                                            @isset($oldProjectId)
                                                                {{ $oldProjectId == $project->id ? 'selected' : '' }}
                                                            @endisset>
                                                            {{ $project->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <div class="form-group">
                                            <label class="form-label">Thực hiện</label>
                                            <select class="custom-select" name="person_id" id="person">
                                                <option value="">-- chọn </option>
                                                @isset($people)
                                                    @foreach ($people as $person)
                                                        <option value="{{ $person->id }}"
                                                            @isset($ooldPersonIdld)
                                                                {{ $oldPersonId == $person->id ? 'selected' : '' }}
                                                            @endisset>
                                                            {{ $person->full_name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <div class="form-group">
                                            <label class="form-label">Company</label>
                                            <select class="custom-select" name="company_id" id="companies">
                                                <option value="">-- chọn</option>
                                                @isset($companies)
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}"
                                                            @isset($oldCompanyId)
                                                                {{ $oldCompanyId == $company->id ? 'selected' : '' }}
                                                            @endisset>
                                                            {{ $company->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <div class="form-group">
                                            <label class="form-label">Độ ưu tiên</label>
                                            <select class="custom-select" name="priority" id="priority">
                                                <option value="1"
                                                    @isset($oldPriority)
                                                        {{ $oldPriority == 1 ? 'selected' : '' }}
                                                    @endisset>
                                                    Cao
                                                </option>
                                                <option value="2"
                                                    @isset($oldPriority)
                                                    {{ $oldPriority == 2 ? 'selected' : '' }}
                                                @endisset>
                                                    Trung bình
                                                </option>
                                                <option value="3"
                                                    @isset($oldPriority)
                                                    {{ $oldPriority == 3 ? 'selected' : '' }}
                                                @endisset>
                                                    Thấp
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <div class="form-group">
                                            <label class="form-label">Trạng thái</label>
                                            <select class="custom-select" name="status" id="status">
                                                <option value="1"
                                                    @isset($oldStatus)
                                                    {{ $oldStatus == 1 ? 'selected' : '' }}
                                                @endisset>
                                                    Mới tạo
                                                </option>
                                                <option value="2"
                                                    @isset($oldStatus)
                                                    {{ $oldStatus == 2 ? 'selected' : '' }}
                                                @endisset>
                                                    Đang làm
                                                </option>
                                                <option value="3"
                                                    @isset($oldStatus)
                                                    {{ $oldStatus == 3 ? 'selected' : '' }}
                                                @endisset>
                                                    Hoàn thành
                                                </option>
                                                <option value="4"
                                                    @isset($oldStatus)
                                                    {{ $oldStatus == 4 ? 'selected' : '' }}
                                                @endisset>
                                                    Tạm hoãn
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <div class="row align-items-end">
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary">Lọc</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-12 my-2">
                            <div type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i
                                    class="fa-solid fa-plus mr-2"></i> Thêm mới</div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-12 my-2">
                            <a href="{{ route('task.export') }}" class="btn btn-danger pull-right"><i
                                    class="fa-solid fa-download"></i> Tải xuống (excel)</a>
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
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span class="fa fa-times"></span>
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
                                        <th scope="col">Tên</th>
                                        <th scope="col">Dự án</th>
                                        <th scope="col">Thực hiện</th>
                                        <th scope="col">Bắt đầu</th>
                                        <th scope="col">Kết thúc</th>
                                        <th scope="col">Ưu tiên</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($tasks)
                                        @if ($tasks->count() > 0)
                                            @foreach ($tasks as $task)
                                                <tr>
                                                    <th scope="row">{{ $task->id }}</th>
                                                    <td>{{ $task->name }}</td>
                                                    <td>{{ $task->project->name }}</td>
                                                    <td>{{ $task->person->full_name }}</td>
                                                    <td>{{ $task->start_time }}</td>
                                                    <td>{{ $task->end_time }}</td>
                                                    <td>
                                                        @php
                                                            if ($task->priority == 1) {
                                                                $badgeClass = 'badge-danger';
                                                                $badgeText = 'Cao';
                                                            } elseif ($task->priority == 2) {
                                                                $badgeClass = 'badge-warning';
                                                                $badgeText = 'Trung bình';
                                                            } elseif ($task->priority == 3) {
                                                                $badgeClass = 'badge-success';
                                                                $badgeText = 'Thấp';
                                                            }
                                                        @endphp

                                                        <span
                                                            class="badge badge-pill {{ $badgeClass }}">{{ $badgeText }}</span>
                                                    </td>
                                                    <td>
                                                        @php
                                                            if ($task->status == '1') {
                                                                $badgeClass = 'badge-danger';
                                                                $badgeText = 'Mới tạo';
                                                            } elseif ($task->status == '2') {
                                                                $badgeClass = 'badge-warning';
                                                                $badgeText = 'Đang làm';
                                                            } elseif ($task->status == '3') {
                                                                $badgeClass = 'badge-success';
                                                                $badgeText = 'Hoàn thành';
                                                            } elseif ($task->status == '4') {
                                                                $badgeClass = 'badge-primary';
                                                                $badgeText = 'Tạm hoãn';
                                                            }
                                                        @endphp
                                                        <span
                                                            class="badge badge-pill {{ $badgeClass }}">{{ $badgeText }}</span>
                                                    </td>
                                                    <td>{{ $task->description }}</td>
                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a href="#" class="text-secondary"><i
                                                                        class="fa fa-edit"
                                                                        onclick="onUpdate(event,'{{ route('task.update', ['task' => $task->id]) }}','{{ $task }}')"></i></a>
                                                            </li>
                                                            <li><a href="#" class="text-danger"
                                                                    onclick="onDelete(event,'{{ route('task.destroy', ['task' => $task->id]) }}')"><i
                                                                        class="fa-solid fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </td>
                                            @endforeach
                                        @endif
                                    @endisset
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @isset($task)
            @if ($tasks->count() > 0)
                <div class="pagination justify-content-center">
                    {{ $tasks->links('pagination::bootstrap-4') }}
                </div>
            @endif
        @endisset
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('task.store') }}" id="add-form">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm mới</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @isset($projects)
                                @if ($projects->count() > 0)
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Dự án</label>
                                            <select class="custom-select" name="project_id" id="projects">
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endisset
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên công việc</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Ví dụ: Xây dựng phân trang, Xây dựng model, ...">
                                </div>
                            </div>
                            @isset($people)
                                @if ($people->count() > 0)
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Thực hiện</label>
                                            <select class="custom-select" name="person_id" id="person">
                                                @foreach ($people as $person)
                                                    <option value="{{ $person->id }}">{{ $person->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endisset
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="start_time" class="col-form-label">Bắt đầu</label>
                                    <input class="form-control" type="date" value="2018-03-05" id="start_time"
                                        name="start_time">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="end_time" class="col-form-label">Kết thúc</label>
                                    <input class="form-control" type="date" value="2018-03-05" id="end_time"
                                        name="end_time">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Độ ưu tiên</label>
                                    <select class="custom-select" name="priority" id="priority">
                                        <option value="1">Cao</option>
                                        <option value="2">Trung bình</option>
                                        <option value="3">Thấp</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Thực hiện</label>
                                    <select class="custom-select" name="status" id="status">
                                        <option value="1">Mới tạo</option>
                                        <option value="2">Đang làm</option>
                                        <option value="3">Hoàn thành</option>
                                        <option value="4">Tạm hoãn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="description">Mô tả</label>
                                <textarea name="description" class="form-control" id="description" rows="2"></textarea>
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
                        <h5 class="modal-title">Thêm mới</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @isset($projects)
                                @if ($projects->count() > 0)
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Dự án</label>
                                            <select class="custom-select" name="project_id" id="projects">
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endisset
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên công việc</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Ví dụ: Xây dựng phân trang, Xây dựng model, ...">
                                </div>
                            </div>
                            @isset($people)
                                @if ($people->count() > 0)
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Thực hiện</label>
                                            <select class="custom-select" name="person_id" id="person">
                                                @foreach ($people as $person)
                                                    <option value="{{ $person->id }}">{{ $person->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endisset
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="start_time" class="col-form-label">Bắt đầu</label>
                                    <input class="form-control" type="date" value="2018-03-05" id="start_time"
                                        name="start_time">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="end_time" class="col-form-label">Kết thúc</label>
                                    <input class="form-control" type="date" value="2018-03-05" id="end_time"
                                        name="end_time">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Độ ưu tiên</label>
                                    <select class="custom-select" name="priority" id="priority">
                                        <option value="1">Cao</option>
                                        <option value="2">Trung bình</option>
                                        <option value="3">Thấp</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Thực hiện</label>
                                    <select class="custom-select" name="status" id="status">
                                        <option value="1">Mới tạo</option>
                                        <option value="2">Đang làm</option>
                                        <option value="3">Hoàn thành</option>
                                        <option value="4">Tạm hoãn</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="description">Mô tả</label>
                                <textarea name="description" class="form-control" id="description" rows="2"></textarea>
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
