@extends('admin.admin-master')

@section('title')
Admin | View Contact Lists
@endsection
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Contact Page</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h4 class="card-header">Recently Contacted you</h4>
                        <div class="card-body">    
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th> Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
        
        
                                <tbody>        
                                    @php($i = 1)
                                    @foreach($contact as $item)
                                <tr>
                                    <td> {{ $i++ }} </td>
                                    <td> {{ $item->name }} </td>
                                    <td> {{ $item->email }} </td>
                                    <td> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </td>
        
                                    <td>
                                        <button class="btn btn-info sm" title="View Message" data-bs-toggle="modal" data-bs-target="#ViewMessage{{ $item->id }}"> <i class="fas fa-eye"></i> </button>
                                        
                                        <a href="{{ route('delete.contact', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i> </a>
                                    </td>
        
                                </tr>
    
                                    <!-- Modal -->
                            <div class="modal fade" id="ViewMessage{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Message from {{ $item->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h6>Subject: {{ $item->subject }}</h6>
                                        {{ $item->message }} 
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                                @endforeach
        
                                </tbody>
                            </table>
    
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
    
    
    
            </div>

        </div>
    </div>
@endsection
