@extends('layouts.customer')

@section('content')
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
                        <div class="profile__wrap col-12 ">
                            @if ($errors->any())
                            <div class="w-100 alert alert-danger">
                                <ul class="m-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @if (session()->has('status'))
                            <div class="w-100 alert alert-success">
                                <p>Your profile was updated successful!</p>
                            </div>
                            @endif
                            <div class="d-flex flex-wrap profile__wrap-body row">
                                <form class="form form-horizontal row-separator needs-validation w-100" novalidate=""
                                    id="form" method="POST" action="{{ route('post_profile') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Username</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Name"
                                                    value="{{ Auth::user()->user_name }}" name="user_name" required>
                                                <div class="invalid-feedback">User name is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Old
                                                Password</label>
                                            <div class="col-md-9">
                                                <input type="password" class="pass form-control" name="password"
                                                    placeholder="Old password">
                                                <div class="invalid-feedback">Old password is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">New
                                                Password</label>
                                            <div class="col-md-9">
                                                <input type="password" class="pass form-control" name="password_new"
                                                    placeholder="New password">
                                                <div class="invalid-feedback">New password is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Confirm
                                                Password</label>
                                            <div class="col-md-9">
                                                <input type="password" class="pass form-control" name="password_confirm"
                                                    placeholder="Confirm password">
                                                <div class="invalid-feedback">Please confirm your password
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Mobile</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    value="{{ Auth::user()->mobile }}" name="mobile"
                                                    placeholder="01000-0000-0" required>
                                                <div class="invalid-feedback ">Mobile is required
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput1">Email</label>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ Auth::user()->email }}" placeholder="mail@gmail.com"
                                                    required>
                                                <div class="invalid-feedback ">Email is required
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput6">Gender</label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="" name="gender" required>
                                                    <option value="0" {{ Auth::user()->gender == 0 ? 'selected' : '' }}>
                                                        Female</option>
                                                    <option value="1"
                                                        {{{ Auth::user()->gender == 1 ? 'selected' : '' }}}>Male
                                                    </option>
                                                    <option value="2"
                                                        {{{ Auth::user()->gender == 2 ? 'selected' : '' }}}>Other
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-auto">
                                            <label class="col-md-3 label-control" for="projectinput6">Birthday</label>
                                            <div class="col-md-9">
                                                <div class="form-group mb-0 d-flex select-group"
                                                    data-birthday="{{ Auth::user()->birthday}}">
                                                    <div class="col-4 col-lg-4 p-0">
                                                        <div class="select-wrap ">
                                                            <select class="form-control" name="year" required>
                                                                <option selected disabled hidden value>Choose year
                                                                </option>
                                                            </select>
                                                            <i class="fas fa-chevron-down"></i>
                                                            <i class="fas fa-birthday-cake" data-toggle="tooltip"
                                                                title="Birthday"></i>
                                                            <div class=" invalid-feedback invalid-feedback-year">Year is
                                                                required</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-lg-4  p-0 pl-lg-2 pr-lg-2">
                                                        <div class="select-wrap ">
                                                            <select class="form-control" name="month" required>
                                                                <option selected disabled hidden value>Choose month
                                                                </option>
                                                            </select>
                                                            <i class="fas fa-chevron-down"></i>
                                                            <div class=" invalid-feedback invalid-feedback-month">Month
                                                                is required</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-lg-4 p-0">
                                                        <div class="select-wrap ">
                                                            <select class="form-control" name="date" required>
                                                                <option disabled hidden selected value>Choose date
                                                                </option>
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
                                            <label class="col-md-3 label-control" for="projectinput6">Avatar</label>
                                            <div class="col-md-9">
                                                <div class="box has-advanced-upload" method="post" action=""
                                                    enctype="multipart/form-data">
                                                    <div class="box__input">
                                                        <img src="{{ optional(Auth::user()->getAvatar)->url ?? asset('images/overview/upload-black.PNG') }} "
                                                            style="width: 3em" class="m-auto mw-100" id="myImg">
                                                        <input class="box__file" type="file" name="avatar_thumb[]"
                                                            id="file">
                                                        <label
                                                            class="box__dragndrop box__button justify-content-center">
                                                            Limit data 6MB
                                                            <br>
                                                            Format: JPEG, PNG, SVG, JPG
                                                        </label>
                                                        <label for="file" class="upload-btn btn "
                                                            style="cursor: pointer">Upload</label>
                                                    </div>
                                                    <div class="box__uploading">Uploading&hellip;</div>
                                                    <div class="box__success">Done!</div>
                                                    <div class="box__error">Error! <span></span>.</div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="form-actions">
                                        <button class="btn btn-primary d-block ml-auto" type="submit">Save
                                            changes</button>
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
    $(document).ready(function(){
        generateDateSelectbox();
        $('.match-height .card').matchHeight({
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        });
    })
    
</script>
@stop