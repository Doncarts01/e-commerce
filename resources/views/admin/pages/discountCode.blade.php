@extends('admin.admin-master')

@section('title')
Admin | View coupons
@endsection
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Coupon Code List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">
                                    View All Coupon Codes 
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">View Coupon Code </h5>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <a href="{{ route('add_discount') }}" class="btn btn-primary float-end">Add Coupon Code </a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>%(per) / $(amt)</th>
                                            <th>Expired Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Updated at</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php($i = 1)
                                        @foreach ($coupon as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->type }}</td>
                                                <td>{{ $item->percent_amount }}</td>
                                                <td>{{ Carbon\Carbon::parse($item->expire_date)->diffForHumans() }}</td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <span class="badge badge-soft-success"><b>Active</b></span>
                                                    @else
                                                        <span class="badge badge-soft-warning"><b>Inactive</b></span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-info sm" title="View Message"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ViewMessage{{ $item->id }}"> <i
                                                            class="fas fa-edit"></i> </button>

                                                    <a href="{{ route('delete_discount', $item->id) }}"
                                                        class="btn btn-danger sm" title="Delete Data" id="delete"> <i
                                                            class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="ViewMessage{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Coupon
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('update_discount') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $item->id }}">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        id="floatingInput" value="{{ $item->name }}"
                                                                        name="name">
                                                                    <label for="floatingInput">coupon Name</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <select class="form-select" id="floatingSelect"
                                                                        aria-label="Floating label select example"
                                                                        name="type">
                                                                        <option value="Amount"
                                                                            {{ $item->type == 'Amount' ? 'selected' : '' }}>
                                                                            Amount</option>
                                                                        <option value="Percent"
                                                                            {{ $item->type == 'Percent' ? 'selected' : '' }}>
                                                                            Percent</option>
                                                                    </select>
                                                                    <label for="floatingSelect">Change Status</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        id="floatingInput" value="{{ $item->percent_amount }}"
                                                                        name="percent_amount">
                                                                    <label for="floatingInput">Percent/Amount</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="date" class="form-control"
                                                                        id="floatingInput" value="{{ $item->expire_date }}"
                                                                        name="expire_date">
                                                                    <label for="floatingInput">Expiry Date</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <select class="form-select" id="floatingSelect"
                                                                        aria-label="Floating label select example"
                                                                        name="status">
                                                                        <option value="0"
                                                                            {{ $item->status == '0' ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="1"
                                                                            {{ $item->status == '1' ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                    </select>
                                                                    <label for="floatingSelect">Change Status</label>
                                                                </div>


                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Update Coupon">
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
@endsection
