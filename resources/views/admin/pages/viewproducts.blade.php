@extends('admin.admin-master')

@section('title')
Admin | View Products
@endsection
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="active">
                                    <a href="{{ route('add_products') }}" class="btn btn-primary">Add Products</a>
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
                        <h5 class="card-header">View Products</h5>
                        <div class="card-body">
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
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th><input type='checkbox' id='selectAllContacts' /></th>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Sub-Category</th>
                                            <th colspan="">Is Featured</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Updated at</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php($i = 1)
                                        @foreach ($products as $item)
                                            <tr>
                                                <td><input type='checkbox' class='selectContact'
                                                        value="{{ $item->id }}" />
                                                </td>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ Str::limit($item->title , 20) }}</td>
                                                <td>{{ !empty($item['productCategory']['name']) ? $item['productCategory']['name'] : 'No Category Selected' }}</td>
                                                <td>{{ !empty($item['productSubCategory']['name']) ? $item['productSubCategory']['name'] : 'No SubCategory Selected' }}</td>
                                                <td>
                                                    <select name="" id="{{ $item->id }}" class="form-select changeStatus">
                                                        <option {{ ($item->isFeatured == 0) ? 'selected' : '' }} value="0">Not Featured </option>
                                                        <option {{ ($item->isFeatured == 1) ? 'selected' : '' }} value="1">Featured </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <span class="badge badge-soft-success"><b>Active</b></span>
                                                    @else
                                                        <span class="badge badge-soft-warning"><b>Inactive</b></span>
                                                    @endif
                                                </td>
                                                <td>

                                                    <a href="{{ route('edit_product', $item->id) }}"
                                                        class="btn btn-primary sm" title="Edit Product"> <i
                                                            class="fas fa-edit"></i>
                                                    </a>

                                                    <a href="{{ route('delete_product', $item->id) }}"
                                                        class="btn btn-danger sm" title="Delete Data" id="delete"> <i
                                                            class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                                            </tr>

                                            <!-- Modal -->
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
                                text: "Delete selected Brands?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    let url = `{{ url('admin/delete-selected-brands') }}`;
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
                                                    'Brands have been deleted.',
                                                    'success'
                                                );
                                                setTimeout(() => {
                                                    location.reload();
                                                }, 1500);
                                            } else {
                                                Swal.fire(
                                                    'Error!',
                                                    data.message || 'Failed to delete Brands.',
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
                                title: `Are you sure you want to ${statusText} selected Brands?`,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, update it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    let url = `{{ url('admin/update-selected-brands-status') }}`;
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
                                                    'Brand status successfully updated.',
                                                    'success'
                                                );
                                                setTimeout(() => {
                                                    location.reload();
                                                }, 1500);
                                            } else {
                                                Swal.fire(
                                                    'Error!',
                                                    data.message || 'Failed to update brand status.',
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
                        toastr.warning('No brands selected.');
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





                $('body').delegate('.changeStatus', 'change', function() {
                        let status = $(this).val();
                        let product_id = $(this).attr('id');

                        // alert(product_id + '' + status);

                        $.ajax({
                            url: "{{ url('admin/product-feature') }}",
                            type: 'POST',
                            data: {
                                status: status,
                                product_id: product_id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {            
                                if(data.success === true){
                                    toastr.success(data.message);
                                } else {
                                    toastr.error(data.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                // toastr.error('An error occurred: ' + error);
                            }
                        });
                    });
            </script>

        </div>
    </div>
@endsection
