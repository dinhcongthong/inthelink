@extends('layouts.admin')
@section('content')
{{-- setting/my profile --}}
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Your Profile</h3>
            </div>
        </div>
        <div class="profile">
            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <div class="setting__profile page-content p-0">
                            <div class="setting__profile-content">
                                <form class="form form-horizontal row-separator needs-validation w-100" novalidate="" method="POST" action="{{ route('post_profile') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <!-- <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4> -->
                                        <div>
                                            <div class="has-avatar profile-avatar">
                                                <img src="{{ optional(Auth::user()->getAvatar)->url }}" class="avatar-img">
                                                <label for="profile-avatar">
                                                    <img src="{{asset('images/admin/upload.png')}}" class="">
                                                </label>
                                                <input type="file" id="profile-avatar" class="d-none" name="avatar_thumb[]">
                                                <div class="overlay">
                                                    <button class="remove-avatar">Remove</button>
                                                    <div class="avatar-name"></div>
                                                    <div class="avatar-action">Click remove to upload new avatar</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Username</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Name" name="user_name" value="{{ Auth::user()->user_name }}" required>
                                                <div class="invalid-feedback">Username is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Email</label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="mail@gmail.com" required>
                                                <div class="invalid-feedback ">Email is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Password</label>
                                            <div class="col-md-9">
                                                <a href="#" class="align-items-center d-flex" data-toggle="modal" data-target="#modalChangePassword" style="height: 30px">Change password</a>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Phone Number</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="{{ Auth::user()->mobile }}" name="mobile" placeholder="01000-0000-0" required>
                                                <div class="invalid-feedback ">Phone Number is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput6">Gender</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="" name="gender" required>
                                                    <option value="0" {{ Auth::user()->gender == 0 ? 'selected' : '' }}>Female</option>
                                                    <option value="1" {{{ Auth::user()->gender == 1 ? 'selected' : '' }}}>Male</option>
                                                    <option value="2" {{{ Auth::user()->gender == 2 ? 'selected' : '' }}}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput6">Birthday</label>
                                            <div class="col-md-9">
                                                <div class="form-group mb-0 d-flex select-group" data-birthday="{{ Auth::user()->birthday}}">
                                                    <div class="col-4 col-lg-4 p-0">
                                                        <div class="select-wrap ">
                                                            <select class="form-control" name="year" required>
                                                                <option selected disabled hidden value>Choose year</option>
                                                            </select>
                                                            <i class="fas fa-chevron-down"></i>
                                                            <i class="fas fa-birthday-cake" data-toggle="tooltip" title="Birthday"></i>
                                                            <div class=" invalid-feedback invalid-feedback-year">Year is required</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-lg-4  p-0 pl-lg-2 pr-lg-2">
                                                        <div class="select-wrap ">
                                                            <select class="form-control" name="month" required>
                                                                <option selected disabled hidden value>Choose month</option>
                                                            </select>
                                                            <i class="fas fa-chevron-down"></i>
                                                            <div class=" invalid-feedback invalid-feedback-month">Month is required</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-lg-4 p-0">
                                                        <div class="select-wrap ">
                                                            <select class="form-control" name="date" required>
                                                                <option disabled hidden selected value>Choose date</option>
                                                            </select>
                                                            <i class="fas fa-chevron-down"></i>
                                                            <div class="invalid-feedback ">Date is required
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto last">
                                            <label class="col-md-3 label-control" for="projectinput1">Access Level</label>
                                            <div class="col-md-9">
                                                <div class="d-flex align-items-center main-gray" style="height: 30px">Adminstrator</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button class="btn btn-primary d-block ml-auto submit" type="submit">Save</button>
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

<div class="modal fade" id="modalChangePassword">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <i class="fas fa-times pointer" data-dismiss="modal"></i>
            <div class="modal-body">
                <form id="form-password" action="" method="POST">
                    <h5 class="text-center header">
                        Change Password
                    </h5>
                    <div class="form-group row mx-auto">
                        <label class="col-md-3 label-control" for="projectinput1">Current Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" value="{{ Auth::user()->mobile }}" id="old-pass" required>
                            <div class="invalid-feedback ">Current Password is required
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mx-auto">
                        <label class="col-md-3 label-control" for="projectinput1">New Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" value="{{ Auth::user()->mobile }}"  id="new-pass" required>
                            <div class="invalid-feedback ">New Password is required
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mx-auto last">
                        <label class="col-md-3 label-control" for="projectinput1">Confirm Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" value="{{ Auth::user()->mobile }}" id="pass-confirm" required>
                            <div class="invalid-feedback ">Confirm Password is required
                            </div>
                        </div>
                    </div>
                    <div class="button-group d-flex flex-wrap justify-content-center">
                        <button type="submit" class="btn btn-blue active">Save</button>
                    </div>
                    <!-- <div class="form-group row">
                        <label for=""></label>
                        <input class="form-control" type="password" id="old-pass">
                    </div>
                    <div class="form-group row">
                        <label>New Password</label>
                        <input class="form-control" type="password" id="new-pass">
                        <span>This field is required</span>
                    </div>
                    <div class="form-group row">
                        <label>Confirm Password</label>
                        <input class="form-control" type="password" id="pass-confirm">
                    </div> -->
                </form>

            </div>
        </div>
    </div>
</div>

@stop
@section('scripts')
<script>
    $(document).ready(function() {
        generateDateSelectbox();

        $('.alert-group').css('display', 'block').fadeOut(5000);
        $('.remove-avatar').on('click', function(ev) {
            ev.preventDefault();
            $(this).closest('.profile-avatar').find('label[for="profile-avatar"]').css('display', 'block');
            $(this).closest('.profile-avatar').removeClass('has-avatar');
        });
        $('body').on('change', 'input[type="file"]', function(e) {
            let self = this;
            if ($(this).attr('id') == 'profile-avatar' && $(this)[0].files[0].type != 'video/mp4') {
                $(this).prev().css('display', 'none');
                $(this).prev().prev().attr('src', URL.createObjectURL(this.files[0]));
                $(this).closest('.profile-avatar').addClass('has-avatar').find('.overlay .avatar-name').html(this.files[0].name);

            }
        });

        $('#form-password').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                    url: baseUrl + '/admin/setting/post-update-password',
                    data: {
                        password: $('#old-pass').val(),
                        newPassword: $('#new-pass').val(),
                        passConfirm: $('#pass-confirm').val()
                    },
                    method: 'POST'
                })
                .done(function(res) {
                    if (res == 1) {
                        BootstrapDialog.show({
                            title: 'Update Password',
                            message: 'Update password was successful!',
                            type: BootstrapDialog.TYPE_SUCCESS,
                        });
                        $('#modalChangePassword').modal('hide');
                    } else {
                        BootstrapDialog.show({
                            title: 'Update Password',
                            message: 'Update password was failed!',
                            type: BootstrapDialog.TYPE_DANGER,
                        });
                    }
                })
                .fail(function(xhr, status, errors) {
                    console.log(xhr.responseText);
                })
        })
    });
</script>
@stop