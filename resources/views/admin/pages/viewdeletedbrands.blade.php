@extends('admin.admin-master')

@section('title')
Admin | Recently Deleted Brands
@endsection
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Brand List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">
                                    Deleted Brands
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
                        <h5 class="card-header">Recently Deleted Brands</h5>
                        <div class="card-body">
                            {{-- <div class="row mb-3">
                                <div class="col-3">
                                    <select name="bulkOptions" id="bulkOptions" class="form-select">
                                        <option value="0">Select Options</option>
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                        <option value="clone">Clone</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-success">Apply</button>
                                    <a href="{{ route('add_category') }}" class="btn btn-primary">Add New Category</a>
                                </div>
                            </div> --}}

                            <div class="table-responsive">
                                <table id="example" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th><input type='checkbox' id='selectAllContacts' /></th>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Updated at</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php($i = 1)
                                        @foreach ($brand as $item)
                                            <tr>
                                                <td><input type='checkbox' class='selectContact'
                                                        value="{{ $item->id }}" />
                                                </td>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <span class="badge badge-soft-success"><b>Active</b></span>
                                                    @else
                                                        <span class="badge badge-soft-warning"><b>Inactive</b></span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('restore_brand', $item->id) }}"
                                                        class="btn btn-success sm" title="Delete Data" id="restore"> Restore
                                                    </a>
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




            <script>
                document.getElementById('selectAllContacts').addEventListener('click', function(event) {
                    var checkboxes = document.querySelectorAll('.selectContact');
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = event.target.checked;
                    });
                });


                document.getElementById('deleteSelected').addEventListener('click', function() {
                    let confirmation = confirm('Are you sure you want to delete selected?');

                    if (confirmation) {
                        var selectedIds = [];
                        var checkboxes = document.querySelectorAll('.selectContact:checked');
                        checkboxes.forEach(function(checkbox) {
                            selectedIds.push(checkbox.value);
                        });

                        if (selectedIds.length > 0) {
                            let url = `{{ url('admin/delete-selected-contacts') }}`;
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
                                        toastr.success(data.message || 'Contacts successfully deleted.');
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1500);
                                    } else {
                                        toastr.error(data.message || 'Failed to delete contacts.');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    toastr.error('An error occurred. Please try again.');
                                });
                        } else {
                            toastr.warning('No contacts selected.');
                        }
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
