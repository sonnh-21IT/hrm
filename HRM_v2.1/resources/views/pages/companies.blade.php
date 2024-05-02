@extends('layout.master')

@section('title')
    <h4 class="page-title pull-left">Companies</h4>
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
            var inputCode = form.querySelector('input[name="code"]')
            var inputName = form.querySelector('input[name="name"]')
            var inputAddress = form.querySelector('input[name="address"]')

            var data = JSON.parse(jsonData)
            inputCode.value = data.code
            inputName.value = data.name
            inputAddress.value = data.address
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
                                        <th scope="col">Address</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($companies)
                                        @if ($companies->count() > 0)
                                            @foreach ($companies as $company)
                                                <tr>
                                                    <th scope="row">{{ $company->id }}</th>
                                                    <td>{{ $company->code }}</td>
                                                    <td>{{ $company->name }}</td>
                                                    <td>{{ $company->address }}</td>
                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a href="#" class="text-secondary"><i
                                                                        class="fa fa-edit"
                                                                        onclick="onUpdate(event,'{{ route('company.update', ['company' => $company->id]) }}','{{ $company }}')"></i></a>
                                                            </li>
                                                            <li><a href="#" class="text-danger"
                                                                    onclick="onDelete(event,'{{ route('company.destroy', ['company' => $company->id]) }}')"><i
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
        @isset($companies)
            @if ($companies->count() > 0)
                <div class="pagination justify-content-center">
                    {{ $companies->links('pagination::bootstrap-4') }}
                </div>
            @endif
        @endisset
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('company.store') }}" id="add-form">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm mới</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label for="company_code">Mã Công ty</label>
                                    <input name="code" type="text" class="form-control" id="company_code"
                                        placeholder="Ví dụ: FPT,IY,...">
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12">
                                <div class="form-group">
                                    <label for="company_name">Tên Công ty</label>
                                    <input name="name" type="text" class="form-control" id="company_name"
                                        placeholder="Ví dụ: FPT Software, IYel">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input name="address" type="text" class="form-control" id="address">
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
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-5 col-sm-12">
                                <div class="form-group">
                                    <label for="company_code">Mã Công ty</label>
                                    <input name="code" type="text" class="form-control" id="company_code"
                                        placeholder="Ví dụ: FPT,IY,...">
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12">
                                <div class="form-group">
                                    <label for="company_name">Tên Công ty</label>
                                    <input name="name" type="text" class="form-control" id="company_name"
                                        placeholder="Ví dụ: FPT Software, IYel">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input name="address" type="text" class="form-control" id="address">
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
