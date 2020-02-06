@extends('layouts.admin')
@section('content')
{{-- setting/my profile --}}
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Customer's Detail</h3>
                <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('users.index') }}">Users</a>
                        </li>
                        <li class="breadcrumb-item active">Customer {{ $user->id }}
                        </li>
                    </ol>
                </div>
                </div>
            </div>
        </div>
        <div class="profile">
            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <div class="setting__profile page-content p-0">
                            <div class="setting__profile-content">
                                <form class="form form-horizontal w-100">
                                    @csrf
                                    <div class="form-body">
                                        <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->
                                        <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="projectinput1">Avatar</label>
                                            <div class="col-md-9">
                                                <img src="{{ optional($user->getAvatar)->url ?? asset('images/overview/user-no-avatar.png') }}" class="obj-contain" width='90' height="90">
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Username</label>
                                            <div class="col-md-9">
                                                <p class="form-control col-md-6 form-control-plaintext m-0"> {{ $user->user_name }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Email</label>
                                            <div class="col-md-9">
                                                <p class="form-control col-md-6 form-control-plaintext m-0">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Phone Number</label>
                                            <div class="col-md-9">
                                                <p class="form-control col-md-6 form-control-plaintext m-0">{{ $user->mobile }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput6">Gender</label>
                                            <div class="col-md-9">
                                                <p class="form-control col-md-6 form-control-plaintext m-0">{{ GENDER[$user->gender] }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput6">Birthday</label>
                                            <div class="col-md-9">
                                                <p class="form-control col-md-6 form-control-plaintext m-0">{{ $user->birthday }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop