@extends('layout.master')

@section('title')
    <h4 class="page-title pull-left">Departments</h4>
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
            var input = form.querySelector('input[name="name"]')
            var inputDesc = form.querySelector('textarea[name="description"]')

            var data = JSON.parse(jsonData)
            inputRole.value = data.role
            inputDesc.value = data.description
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
                    </div>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Thuộc phòng ban</th>
                                        <th scope="col">Công ty</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Phòng nhân sự</td>
                                        <td>Không</td>
                                        <td>FPT Software</td>
                                        <td>
                                            <?php
                                            $data = [
                                                'id' => 1,
                                                'name' => 'Phòng nhân sự',
                                                'parent' => [],
                                                'company' => [
                                                    'id' => 1,
                                                    'code' => 'FPT',
                                                    'name' => 'FPT Software',
                                                    'address' => '454 Trần Đại Nghĩa, Ngũ Hành Sơn, Đà Nẵng',
                                                ],
                                            ];
                                            
                                            $jsonData = json_encode($data);
                                            ?>
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
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Tên phòng ban</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Ví dụ: Phòng nhân sự, C++, ...">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <select class="custom-select" name="company_id">
                                        <option value="1">FPT</option>
                                        <option value="2">IYel</option>
                                        <option value="3">Apple</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Thuộc phòng ban</label>
                                    <select class="custom-select" name="parent_id">
                                        <option value="">Không</option>
                                        <option value="1">Phòng nhân sự</option>
                                    </select>
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
                        <h5 class="modal-title">Thêm mới</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Tên phòng ban</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="Ví dụ: Phòng nhân sự, C++, ...">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <select class="custom-select" name="company_id">
                                        <option value="1">FPT</option>
                                        <option value="2">IYel</option>
                                        <option value="3">Apple</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Thuộc phòng ban</label>
                                    <select class="custom-select" name="parent_id">
                                        <option value="">Không</option>
                                        <option value="1">Phòng nhân sự</option>
                                    </select>
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
