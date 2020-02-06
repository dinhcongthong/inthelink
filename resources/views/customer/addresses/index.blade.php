@extends('layouts.customer')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-1 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block border-0">Addresses</h3>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group">
                    <button onclick="openModalAddress('new')"
                        class="btn-new btn btn-primary round waves-effect waves-light" type="button"
                        data-target="#modalAddress" data-toggle="modal">
                        <i class="ft-plus"></i>
                        New address
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            @if ($errors->any())
            <div class="col-12 alert alert-danger">
                @foreach ($errors->all() as $error)
                <ul class="m-0">
                    <li>{{ $error }}</li>
                </ul>
                @endforeach
            </div>
            @endif
        </div>
        <div class="content-body">
            <div class="card address__customer">
                <div class="card-content">
                    <div class="card-body">
                        <div class="address__wrap">
                            <div class="d-flex flex-wrap address__wrap-body">
                                <div class="container-fluid col-12 no-gutters">
                                    @foreach ($address as $addr)
                                    <div class="address__row row justify-content-center justify-content-sm-start {{ $addr->set_default ? 'default' : '' }}">
                                        <div class="address__row-left py-2 col-sm-6">
                                            <div class="d-flex flex-wrap justify-content-md-start justify-content-between">
                                                <label for="name" class="mr-1 col-form-label">Name:</label>
                                                <div class="address__info">
                                                    <div class="h-100 d-flex align-items-center" id="name" value="">
                                                        {{ $addr->name }} &nbsp;{!! $addr->set_default ?
                                                        '<span>Default</span>' : '' !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" d-flex flex-wrap justify-content-md-start justify-content-between">
                                                <label for="phonenumber" class="mr-1 col-form-label">
                                                    Phone number:
                                                </label>
                                                <div class="address__info">
                                                    <div id="phonenumber" value="">{{ $addr->phone }}</div>
                                                </div>
                                            </div>
                                            <div class=" d-flex flex-wrap justify-content-md-start justify-content-between">
                                                <label for="address" class="mr-1 col-form-label">Address:</label>
                                                <div class="address__info ">
                                                    <div id="address" value="">
                                                        {{ $addr->address }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="address__row-right col-12 col-sm-6 ml-sm-auto py-2">
                                            <div class="d-flex justify-content-between mb-3">
                                                <p class="address-edit"
                                                    onclick="openModalAddress('edit', '{{ $addr->id }}', '{{ $addr->name }}', '{{ $addr->phone }}', '{{ $addr->address }}', '{{ $addr->set_default }}')">
                                                    Edit
                                                </p>
                                                <p class="address-delete red " onclick="deleteAddress(this, '{{ $addr->id }}')">Delete</p>
                                            </div>

                                            <button
                                                class="btn btn-outline-primary {{ $addr->set_default ? 'active' : '' }}"
                                                onclick="setDefault({{ $addr->id }})" id="form-1">Set
                                                default</button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modals --}}
<div class="modal fade" id="addr-delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this address?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-del">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="modalAddress" tabindex="-1" data-id="" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600">Update address</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add-addr-form" action="" novalidate="" class="needs-validation">
                <div class="modal-body">
                    <label>Name: </label>
                    <div class="form-group">
                        <input type="text" class="name form-control" name="name"
                            placeholder="Please enter person in charge name" required>
                        <div class="invalid-feedback">Person in charge is required</div>
                    </div>

                    <label>Phone: </label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="01000-0000-0" required>
                        <div class="invalid-feedback">Phone is required</div>
                    </div>

                    <label>Address: </label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="Address" required>
                        <div class="invalid-feedback">Address is required</div>
                    </div>

                    <div class="term__agree">
                        <div class="custom-control form-group custom-checkbox">
                            <input type="checkbox" class="custom-control-input form-check-input" id="set" name="">
                            <label class="custom-control-label text-muted" for="set">
                                Set default
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" id="addr-save" class="btn btn-outline-primary btn-lg">Complete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="{{ asset('js/customer/address.js') }}"></script>
@endsection