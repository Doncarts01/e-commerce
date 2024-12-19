@extends('admin.admin-master')

@section('title')
Admin | View All Notifications
@endsection
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Notifications</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">{{ $pageList->count() }} Notification(s) </h5>
                        <div class="card-body">
                            {{-- <div class="row mb-3"></div> --}}

                            <div class="table-responsive">
                                @foreach ($pageList as $item)
                                    <a href="{{ $item->url }}?notification_id={{ $item->id }} " class=" notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="ri-checkbox-circle-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1" style="{{ empty($item->is_read) ? 'font-weight: 700' : 'font-weight: 400' }}">{{ $item->message }}</h6>
                                                <div class="font-size-12 text-muted">
                                                    {{-- <p class="mb-1">If several languages coalesce the grammar</p> --}}
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <hr>
                            <ul class="pagination">
                                {{ $pageList->links('vendor.pagination.bootstrap-5') }}
                            </ul>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


        </div>
    </div>
@endsection
