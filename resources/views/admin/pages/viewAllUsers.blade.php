@extends('admin.admin-master')

@section('title')
Admin | View All Customers 
@endsection
@section('admin')

    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="pt-3">View Cistomers List</h4>
                            <p class="card-title-desc">
                            </p>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @php($i = 1)
                                @foreach ($viewAllUsers as $item )
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <img class="rounded-circle" src="{{ (!empty($item->profile_image)) ? url('upload/user_images/'.$item->profile_image) :url('upload/no_image.PNG') }}" alt="{{ $item->name }}" width="40px" height="40px">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->isdelete == 0)
                                            <span class="badge badge-soft-success"><b>Active</b></span>
                                        @else
                                            <span class="badge badge-soft-warning"><b>Banned</b></span>
                                        @endif
                                    <td>{{ $item->email }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('delete_customer', $item->id) }}"
                                            class="btn btn-danger sm" title="Delete Data" id="delete"> <i
                                                class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->








        </div>
    </div>

@endsection 