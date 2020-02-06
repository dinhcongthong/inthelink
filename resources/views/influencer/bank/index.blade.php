@extends('layouts.influencer')


@section('content')

<div class="container-fluid bank common__padding">
    <div class="row">
        <div class="bank__wrap col-12 ">
            <div class="d-flex col-12 p-0 wrap-head">
                <p>Bank account</p>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger w-100">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="col-12 p-0 d-flex flex-wrap bank__wrap-body">
                <div class="bank__card" data-target="#modalBank" data-toggle="modal" alt="card">
                    <div class="d-flex justify-content-between">
                        <p class="bank__card-left"><span>{{ $influencer->bank_name }}</span></p>
                        {{-- <p class="bank__card-right">{{ $influencer->getBank->name }}</p> --}}
                    </div>
                    <img src="{{ optional($influencer->getBankImg)->url ?? asset('images/overview/bank-sign.svg') }}" alt="bank">
                    <p class="bank__card-number">{{ $influencer->bankinfo }}</p>
                    <div class="d-flex justify-content-between">
                        <span class="bank__card-name">{{ $influencer->bank_acc_num }}</span>
                        <img src="{{ asset('images/overview/circle.svg')}}" alt="circle">
                    </div>
                </div>
                <button class="add" data-target="#modalAdd" data-toggle="modal">Edit bank account</button>
            </div>
        </div>
    </div>
</div>

{{-- modal --}}
<div class="modal fade" id="modalAdd">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <p class="head">
                    Edit bank account
                </p>
                <form class="container-fluid form-common needs-validation" novalidate="" enctype="multipart/form-data" id="formAdd" method="POST"
                    action="{{ route('influencer.post_bank') }}">
                    @csrf
                    <div class="input-wrap">
                        <input type="text" class="form-control" placeholder="ID number" name="identity_card"
                        value="{{ $influencer->identity_card }}" required>
                        <i class="fas fa-user" data-toggle="tooltip" title="Identity card"></i>
                        <div class="invalid-feedback">ID is required</div>
                    </div>
                    <div class="input-wrap">
                        <input type="text" class="form-control" placeholder="Bank name" name="bank_name"
                        value="{{ $influencer->bank_name }}" required>
                        <i class="fas fa-university" data-toggle="tooltip" title="Bank name"></i>
                        <div class="invalid-feedback">Account is required</div>
                    </div>
                    <div class="input-wrap">
                        <input type="text" class="form-control" placeholder="Bank account number" name="bank_acc_num"
                        value="{{ $influencer->bank_acc_num }}" required>
                        <i class="far fa-credit-card" data-toggle="tooltip" title="Bank account number"></i>
                        <div class="invalid-feedback">Account is required</div>
                    </div>
                    <div class="invalid-feedback" class="d-none">
                        Sorry, the number did not right
                    </div>

                    <div class="or">
                        <span>Upload Bank image</span>
                    </div>
                    <div class="box has-advanced-upload form-common">
                        <div class="box__input ">
                            <img src="{{ $influencer->getBankImg->url ?? asset('images/overview/upload-black.PNG') }}" style="width: 3em" class="m-auto" id="myImg">
                            <input class="box__file" type="file" name="files[]" id="file">
                            <label class="box__dragndrop box__button justify-content-center">
                                Limit data 6MB
                                <br>
                                Format: JPEG, PNG, SVG, JPG
                            </label>
                            <label for="file" class="upload-btn btn" style="cursor: pointer">Upload</label>
                        </div>
                        <div class="box__uploading">Uploading&hellip;</div>
                        <div class="box__success">Done!</div>
                        <div class="box__error">Error! <span></span>.</div>
                    </div>
                    <div class="d-flex justify-content-around mt-3">
                        <button data-dismiss="modal" class="btn button-cancel">Cancel</button>
                        <button type="submit" class="add">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop