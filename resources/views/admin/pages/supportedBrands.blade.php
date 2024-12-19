@extends('admin.admin-master')

@section('title')
Admin | View Supported Brands
@endsection
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Supported Brands</h4>

                        {{-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">
                                    View All Shipping Charges 
                                </li>
                            </ol>
                        </div> --}}

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Supported Brands </h5>
                        <div class="card-body">
                            <div class="row mb-3"></div>

                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                            <th>Updated at</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php($i = 1)
                                        @foreach ($pageList as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <img src="{{ (!empty($item->image)) ? url($item->image) :url('upload/no_image.jpg') }}" class="img-fluid" alt="" width="50px" height="50px">
                                                </td>
                                                <td>
                                                    <a href="{{ route('supportBRands_edit', $item->id) }}" class="btn btn-info sm" title="Edit pages"> 
                                                        <i class="fas fa-edit"></i> </a>
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                                            </tr>
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
