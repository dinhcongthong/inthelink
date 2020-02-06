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
                                    <div class="address__row row {{ $addr->set_default ? 'default' : '' }}">
                                        <div class="address__row-left col-12 col-md-9">
                                            <div class=" row">
                                                <label for="name" class="col-md-2 col-form-label">Name:</label>
                                                <div class="col-md-10 address__info">
                                                    <div class="h-100 d-flex align-items-center" id="name" value="">
                                                        {{ $addr->name }} &nbsp;{!! $addr->set_default ?
                                                        '<span>Default</span>' : '' !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" row">
                                                <label for="phonenumber" class="col-md-2 col-form-label">
                                                    Phone number:
                                                </label>
                                                <div class="col-md-10 address__info">
                                                    <div id="phonenumber" value="">{{ $addr->phone }}</div>
                                                </div>
                                            </div>
                                            <div class=" row">
                                                <label for="address" class="col-md-2 col-form-label">Address:</label>
                                                <div class="col-md-10 address__info ">
                                                    <div id="address" value="">
                                                        {{ $addr->address }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="address__row-right col-12 col-md-3 pt-3 pb-3">
                                            <div class="d-flex justify-content-between mb-3">
                                                <p class="address-edit"
                                                    onclick="openModalAddress('edit', '{{ $addr->id }}', '{{ $addr->name }}', '{{ $addr->phone }}', '{{ $addr->address }}', '{{ $addr->set_default }}')">
                                                    Edit
                                                </p>
                                                <p class="address-delete red "
                                                    onclick="deleteAddress(this, '{{ $addr->id }}')">Delete</p>
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