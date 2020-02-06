@extends('layouts.admin')
@section('content')
{{-- user/block list --}}
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Block List</h3>
            </div>
        </div>
        <div class="blocklist">
            <div class="content-body">
                <div class="card">
                    <div class="card-body ">
                        <div class="page-content">
                            <div class="page-table--wrap">

                                <div class="table-responsive">
                                    <table id="table_block" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Phone Number</th>
                                                <th>Email</th>
                                                <th>Reason</th>
                                                <th>Gender</th>
                                                <th>Joined Date</th>
                                                <th>Access Level</th>
                                                <th>Command</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('datatables')
<script type="text/javascript" src="{{asset('js/admin/manage_users.js')}}"></script>
<script>
    $(document).ready(function() {})
</script>
@endsection