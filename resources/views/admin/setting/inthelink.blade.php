@extends('layouts.admin')
@section('content')
{{-- setting/my profile --}}
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">INTHELINK's Profile</h3>
            </div>
            <div class="content-header-right col-md-6 col-12 mb-2 ">
                <button class="btn btn-primary float-md-right icon-edit">Edit</button>
            </div>
        </div>
        <div class="profile">
            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <div class="setting__profile page-content p-0">
                            <div class="setting__profile-content">
                                <form class="form form-horizontal row-separator needs-validation w-100" novalidate="" method="POST" action="{{ route('admin.setting.post_inthelink_info') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $info->name }}" required readonly>
                                                <div class="invalid-feedback">Full name is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Address</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Name" name="address" value="{{ $info->address }}" required readonly>
                                                <div class="invalid-feedback">Address is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Email</label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="mail@gmail.com" required readonly>
                                                <div class="invalid-feedback ">Email is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Phone Number</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{ Auth::user()->mobile }}" name="mobile" placeholder="01000-0000-0" required readonly>
                                                <div class="invalid-feedback ">Phone Number is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Website</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{ $info->website }}" name="website" required readonly>
                                                <div class="invalid-feedback ">Website is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Bank Name</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{ $info->bank_name }}" name="bank_name" required readonly>
                                                <div class="invalid-feedback ">Bank is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto last">
                                            <label class="col-md-3 label-control" for="projectinput1">Bank Account Number</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{ $info->bank_acc_num }}" name="bank_name" required readonly>
                                                <div class="invalid-feedback ">Bank's account number is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row pb-2 last">
                                            <label class="col-12 mb-0 d-flex align-items-center justify-content-center">Last changed by {{ $info->getEditor->user_name }} at {{ $info->updated_at->format('Y-m-d H:i:s') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button class="btn btn-primary btn-save d-block ml-auto submit" type="submit">Save</button>
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
@section('scripts')
<script>
    $(document).ready(function() {
        $('body').on('click', '.icon-edit', function() {
            $('form').find('input').each(function(i, e) {
                $(e).prop('readonly', false);
            });
            $('form').find('.btn-save').removeClass('d-none');
        })
    });
</script>
@stop