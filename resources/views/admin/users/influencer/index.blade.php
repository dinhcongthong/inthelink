@extends('layouts.admin')
@section('content')
{{-- users/influencer --}}
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Influencers</h3>
            </div>
        </div>
        <div class="users-influencer">
            <div class="content-body">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <ul class="page-tabs d-flex justify-content-center nav nav-pills">
                                        <li class="nav-item">
                                            <button class="btn nav-link my-1 mr-1 btn-outline-primary active " data-toggle="pill" href="#all">
                                                All
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="btn nav-link my-1 mr-1 btn-outline-primary " data-toggle="pill" href="#waiting">
                                                Waiting
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="btn nav-link my-1 mr-1 btn-outline-primary" data-toggle="pill" href="#accepted">
                                                Accepted
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="btn nav-link my-1 mr-1 btn-outline-primary" data-toggle="pill" href="#declined">
                                                Declined
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 p-0 tab-content">
                                    <div id="all" class="tab-pane  active page-table--wrap">
                                        <div class="page-tool d-flex justify-content-start my-1">
                                            <div class="input-wrap right">
                                                <input name="search-table" class="form-control" type="text" placeholder="Search...">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="table_influencers" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Influencer</th>
                                                        <th>Phone Number</th>
                                                        <th>Email</th>
                                                        <th>Joined Date</th>
                                                        <th>Commission(%)</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="waiting" class="tab-pane page-table--wrap">
                                        <div class="page-tool d-flex justify-content-start my-1">
                                            <div class="input-wrap right">
                                                <input name="search-table" class="form-control" type="text" placeholder="Search...">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="table_influencers_waiting" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Influencer</th>
                                                        <th>Phone Number</th>
                                                        <th>Email</th>
                                                        <th>Joined Date</th>
                                                        <th>Commission(%)</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="accepted" class="tab-pane page-table--wrap">
                                        <div class="page-tool d-flex justify-content-start my-1">
                                            <div class="input-wrap right">
                                                <input name="search-table" class="form-control" type="text" placeholder="Search...">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="table_influencers_accepted" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Influencer</th>
                                                        <th>Phone Number</th>
                                                        <th>Email</th>
                                                        <th>Joined Date</th>
                                                        <th>Commission(%)</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="declined" class="tab-pane page-table--wrap">
                                        <div class="page-tool d-flex justify-content-start my-1">
                                            <div class="input-wrap right">
                                                <input name="search-table" class="form-control" type="text" placeholder="Search...">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="table_influencers_declined" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle w-100">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Influencer</th>
                                                        <th>Phone Number</th>
                                                        <th>Email</th>
                                                        <th>Joined Date</th>
                                                        <th>Commission(%)</th>
                                                        <th>Status</th>
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
                </section>
            </div>
        </div>
    </div>
</div>

@stop
@section('datatables')
<script type="text/javascript" src="{{asset('js/admin/influencer-users.js')}}"></script>
@endsection
