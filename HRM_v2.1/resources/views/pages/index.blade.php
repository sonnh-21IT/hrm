@extends('layout.master')

@section('title')
    <div class="col-md-6 col-sm-12">
        <h4 class="page-title pull-left">Tasks</h4>
    </div>

    <form action="" class="col-md-6 col-sm-12">
        <div class="input-group">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-primary pull-right" data-mdb-ripple-init>search</button>
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
                            <form>
                                <div class="form-row align-items-center">
                                    <div class="col-auto my-1">
                                        <div class="form-group">
                                            <label class="form-label">Dự án</label>
                                            <select class="custom-select" name="project_id" id="projects">
                                                <option value="1">Quản lý nhân sự</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <div class="form-group">
                                            <label class="form-label">Thực hiện</label>
                                            <select class="custom-select" name="person_id" id="person">
                                                <option value="1">Nguyễn Hồng Sơn</option>
                                                <option value="2">Hoàng Văn Hiếu</option>
                                                <option value="3">Ngô Thị Thu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <div class="form-group">
                                            <label class="form-label">Company</label>
                                            <select class="custom-select" name="company_id" id="companies">
                                                <option value="1">FPT</option>
                                                <option value="2">IYel</option>
                                                <option value="3">Apple</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <div class="form-group">
                                            <label class="form-label">Độ ưu tiên</label>
                                            <select class="custom-select" name="priority" id="priority">
                                                <option value="1">Cao</option>
                                                <option value="2">Trung bình</option>
                                                <option value="3">Thấp</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
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
                            <div type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target=""><i
                                    class="fa-solid fa-download"></i> Tải xuống (excel)</div>
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
                                    <tr>
                                        <?php
                                        $data = [
                                            'id' => 1,
                                            'name' => 'xây dụng model',
                                            'project' => [
                                                'id' => 1,
                                                'name' => 'Quản lý nhân sự',
                                                'company' => [
                                                    'id' => 2,
                                                    'code' => 'FPT',
                                                    'name' => 'FPT Software',
                                                    'address' => '454 Trần Đại Nghĩa, Ngũ Hành Sơn, Đà Nẵng',
                                                ],
                                            ],
                                            'person' => [
                                                'full_name' => 'John Doe',
                                                'gender' => 'Nữ',
                                                'birthdate' => '1990-01-01',
                                                'phone_number' => '1234567890',
                                                'address' => '123 Main Street',
                                            ],
                                            'start_time' => '2024-06-25',
                                            'end_time' => '2024-06-27',
                                            'priority' => 3,
                                            'status' => 4,
                                            'description' => 'none',
                                        ];
                                        $jsonData = json_encode($data);
                                        ?>
                                        <th scope="row">1</th>
                                        <td>Xây dựng model</td>
                                        <td>Website quản lý nhân sự</td>
                                        <td>Nguyễn Hồng Sơn</td>
                                        <td>2024-06-25</td>
                                        <td>2024-06-27</td>
                                        <td>
                                            @php
                                                $jsonDataDe = json_decode($jsonData); // Chuyển đổi chuỗi JSON thành đối tượng
                                                $priority = $jsonDataDe->priority;
                                                $status = $jsonDataDe->status;
                                                $badgeClass = '';
                                                $badgeText = '';

                                                if ($priority == 1) {
                                                    $badgeClass = 'badge-danger';
                                                    $badgeText = 'Cao';
                                                } elseif ($priority == 2) {
                                                    $badgeClass = 'badge-warning';
                                                    $badgeText = 'Trung bình';
                                                } elseif ($priority == 3) {
                                                    $badgeClass = 'badge-success';
                                                    $badgeText = 'Thấp';
                                                }
                                            @endphp

                                            <span class="badge badge-pill {{ $badgeClass }}">{{ $badgeText }}</span>
                                        </td>
                                        <td>
                                            @php
                                                if ($status == '1') {
                                                    $badgeClass = 'badge-danger';
                                                    $badgeText = 'Mới tạo';
                                                } elseif ($status == '2') {
                                                    $badgeClass = 'badge-warning';
                                                    $badgeText = 'Đang làm';
                                                } elseif ($status == '3') {
                                                    $badgeClass = 'badge-success';
                                                    $badgeText = 'Hoàn thành';
                                                } elseif ($status == '4') {
                                                    $badgeClass = 'badge-primary';
                                                    $badgeText = 'Tạm hoãn';
                                                }
                                            @endphp
                                            <span class="badge badge-pill {{ $badgeClass }}">{{ $badgeText }}</span>
                                        </td>
                                        <td>none</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="#" class="text-secondary"><i
                                                            class="fa fa-edit"
                                                            onclick="onUpdate(event,'{{ 'Hello' }}','{{ $jsonData }}')"></i></a>
                                                </li>
                                                <li><a href="#" class="text-danger"
                                                        onclick="onDelete(event,'{{ 'Hello' }}')"><i
                                                            class="fa-solid fa-trash-can"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Dự án</label>
                                    <select class="custom-select" name="project_id" id="projects">
                                        <option value="1">Quản lý nhân sự</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên công việc</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Ví dụ: Xây dựng phân trang, Xây dựng model, ...">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Thực hiện</label>
                                    <select class="custom-select" name="person_id" id="person">
                                        <option value="1">Nguyễn Hồng Sơn</option>
                                        <option value="2">Hoàng Văn Hiếu</option>
                                        <option value="3">Ngô Thị Thu</option>
                                    </select>
                                </div>
                            </div>
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
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Dự án</label>
                                    <select class="custom-select" name="project_id" id="projects">
                                        <option value="1">Quản lý nhân sự</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Tên công việc</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Ví dụ: Xây dựng phân trang, Xây dựng model, ...">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Thực hiện</label>
                                    <select class="custom-select" name="person_id" id="person">
                                        <option value="1">Nguyễn Hồng Sơn</option>
                                        <option value="2">Hoàng Văn Hiếu</option>
                                        <option value="3">Ngô Thị Thu</option>
                                    </select>
                                </div>
                            </div>
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
