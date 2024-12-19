@extends('admin.admin-master')

@section('title')
    Admin | View Categories
@endsection
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Category List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">
                                    View All Categories
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
                        <h5 class="card-header">View Categories</h5>
                        <div class="card-body">

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Warning!</strong> All categories must have subcategories before a product can be properly uploaded. <br>
                                Click 
                                <b>
                                    <a href="{{ url('admin/add/sub-category') }}" class="alert-link">here</a>
                                </b>
                                 to add a Subcategory
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <select name="bulkOptions" id="bulkOptions" class="form-select">
                                        <option value="">Select Options</option>
                                        {{-- <option value="0">Active</option>
                                        <option value="1">Inactive</option> --}}
                                        <option value="delete">Delete</option>
                                    </select>
                                </div>
                                <div class="col-9">
                                    <button type="button" id="applyBulkAction" class="btn btn-success">Apply</button>
                                    <a href="{{ route('add_category') }}" class="btn btn-primary float-end">Add New Category</a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th><input type='checkbox' id='selectAllContacts' /></th>
                                            <th>SN</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>In Menu</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Updated at</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php($i = 1)
                                        @foreach ($categories as $item)
                                            <tr>
                                                <td><input type='checkbox' class='selectContact'
                                                        value="{{ $item->id }}" />
                                                </td>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <img src="{{ (!empty($item->image)) ? url($item->image) :url('upload/no_image.jpg') }}" class="img-fluid" alt="" width="50px" height="50px">
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @if ($item->inMenu == 0)
                                                        <span class="badge badge-soft-warning"><b>No</b></span>
                                                    @else
                                                        <span class="badge badge-soft-success"><b>Yes</b></span>
                                                    @endif
                                                </td>
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

                                                    <a href="{{ route('delete_category', $item->id) }}"
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Category
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('update_category') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $item->id }}">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" class="form-control"
                                                                        id="floatingInput" value="{{ $item->name }}"
                                                                        name="name">
                                                                    <label for="floatingInput">Name</label>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <input type="file" class="form-control px-4 catImage" id="image{{ $item->id }}" name="image">
                                                                    <label for="image{{ $item->id }}"></label>
                                            
                                                                    <div class="col-12 mt-2">
                                                                        <img id="showImage{{ $item->id }}" class="rounded avatar-lg showimage" src="{{ (!empty($item->image)) ? url($item->image) : url('upload/no_image.jpg') }}" alt="Card image cap">
                                                                    </div>
                                                                </div>

                                                                <div class="form-floating mb-3">
                                                                    <select class="form-select" id="floatingSelect"
                                                                        aria-label="Floating label select example"
                                                                        name="inMenu">
                                                                        <option value="0"
                                                                            {{ $item->inMenu == '0' ? 'selected' : '' }}>
                                                                            No</option>
                                                                        <option value="1"
                                                                            {{ $item->inMenu == '1' ? 'selected' : '' }}>
                                                                            Yes</option>
                                                                    </select>
                                                                    <label for="floatingSelect">In Menu?</label>
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
                                                                    value="Update Category">
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>

                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        $('#image{{ $item->id }}').change(function(e) {
                                                            var reader = new FileReader();
                                                            reader.onload = function(e) {
                                                                $('#showImage{{ $item->id }}').attr('src', e.target.result);
                                                            }
                                                            reader.readAsDataURL(e.target.files[0]);
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


            <script>
                document.getElementById('selectAllContacts').addEventListener('click', function(event) {
                    var checkboxes = document.querySelectorAll('.selectContact');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = event.target.checked;
                    });
                });

                document.getElementById('applyBulkAction').addEventListener('click', function() {
                    var bulkOption = document.getElementById('bulkOptions').value;
                    var selectedIds = [];
                    var checkboxes = document.querySelectorAll('.selectContact:checked');
                    checkboxes.forEach(function(checkbox) {
                        selectedIds.push(checkbox.value);
                    });

                    if (selectedIds.length > 0) {
                        if (bulkOption === 'delete') {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "Delete selected categories?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    let url = `{{ url('admin/delete-selected-categories') }}`;
                                    fetch(url, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                ids: selectedIds
                                            })
                                        }).then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                Swal.fire(
                                                    'Deleted!',
                                                    'Categories have been deleted.',
                                                    'success'
                                                );
                                                setTimeout(() => {
                                                    location.reload();
                                                }, 1500);
                                            } else {
                                                Swal.fire(
                                                    'Error!',
                                                    data.message || 'Failed to delete categories.',
                                                    'error'
                                                );
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            Swal.fire(
                                                'Error!',
                                                'An error occurred. Please try again.',
                                                'error'
                                            );
                                        });
                                }
                            });
                        } else if (bulkOption === '0' || bulkOption === '1') {
                            let statusText = bulkOption === '0' ? 'activate' : 'deactivate';
                            Swal.fire({
                                title: `Are you sure you want to ${statusText} selected categories?`,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, update it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    let url = `{{ url('admin/update-selected-categories-status') }}`;
                                    fetch(url, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                ids: selectedIds,
                                                status: bulkOption
                                            })
                                        }).then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                Swal.fire(
                                                    'Updated!',
                                                    'Categories status successfully updated.',
                                                    'success'
                                                );
                                                setTimeout(() => {
                                                    location.reload();
                                                }, 1500);
                                            } else {
                                                Swal.fire(
                                                    'Error!',
                                                    data.message || 'Failed to update categories status.',
                                                    'error'
                                                );
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            Swal.fire(
                                                'Error!',
                                                'An error occurred. Please try again.',
                                                'error'
                                            );
                                        });
                                }
                            });
                        } else {
                            toastr.warning('Please select a valid action.');
                        }
                    } else {
                        toastr.warning('No categories selected.');
                    }
                });
            </script>














            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>


            <script src="https://cdn.datatables.net/buttons/2.1.3/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.1.3/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.1.3/js/buttons.print.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

            <!-- DataTables JS -->
            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

            <!-- Buttons JS -->
            <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

            <!-- jsPDF -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
            <script>
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copy',
                            className: 'btn btn-primary'
                        },
                        {
                            extend: 'csv',
                            className: 'btn btn-secondary'
                        },
                        {
                            extend: 'excel',
                            className: 'btn btn-success'
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-danger'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-dark'
                        }
                    ]
                });
            </script>

        </div>
    </div>
@endsection
