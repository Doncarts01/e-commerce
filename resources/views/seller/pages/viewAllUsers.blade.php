@extends('seller.seller-master')

@section('seller')

    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="pt-3">View All Users</h4>
                            <p class="card-title-desc">
                            </p>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
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
                                    <td>{{ "Admin" }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
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