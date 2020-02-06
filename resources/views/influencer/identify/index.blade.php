@extends('layouts.influencer')


@section('content')

<div class="container-fluid bank common__padding">
    @if ($errors->any())
    @foreach ($errors->all() as $item)
    <div class="w-100 alert alert-danger">
        <ul class="m-0">
            <li>{{ $item }}</li>
        </ul>
    </div>
    @endforeach
    @endif
    <div class="row">
        <div class="bank__wrap col-12 ">
            <div class="d-flex col-12 p-0 wrap-head">
                <p>Identify Card</p>
            </div>
            <div class="col-12 p-0 d-flex flex-wrap bank__wrap-body">
                <img src="{{ Auth::user()->identify_font_thumb->url ?? asset('images/overview/no-image-6x4.png') }}" alt="card"
                    class="mr-3 my-3">
                <img src="{{ Auth::user()->identify_back_thumb->url ?? asset('images/overview/no-image-6x4.png') }}" alt="card"
                    class="mr-3 my-3">
                <button class="add" data-target="#modalAddId" data-toggle="modal">Update ID card</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAddId">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content profile ic">
            <div class="modal-body profile__wrap-body p-0">
                <p class="head">
                    Add ID card
                </p>
                <form class="form w-100 d-flex flex-wrap" method="post" action="{{ route('influencer.post_identify') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 col-right">
                        <h6>The front of ID</h6>
                        <div class="mb-3 box has-advanced-upload">
                            <!-- <span class="or d-none d-lg-block">OR</span> -->
                            <div class="box__input ">
                                <img src="{{ asset('images/overview/upload-black.PNG') }}" style="width: 3em"
                                    class="m-auto" id="myImg-front">
                                <input class="box__file" type="file" name="font_file[]" id="file-front"
                                    data-multiple-caption="{count} files selected" multiple />
                                <label class="box__dragndrop box__button justify-content-center">
                                    Limit data 1MB
                                    <br>
                                    Format: JPEG, PNG
                                </label>
                                <label for="file-front" class="upload-btn btn " style="cursor: pointer">Upload</label>
                            </div>
                            <div class="box__uploading">Uploading&hellip;</div>
                            <div class="box__success">Done!</div>
                            <div class="box__error">Error! <span></span>.</div>
                        </div>
                        <h6>The back of ID</h6>
                        <div class="mb-3 box has-advanced-upload">
                            <!-- <span class="or d-none d-lg-block">OR</span> -->
                            <div class="box__input ">
                                <img src="{{asset('images/overview/upload-black.PNG')}}" style="width: 3em"
                                    class="m-auto" id="myImg-front">
                                <input class="box__file" type="file" name="back_file[]" id="file-back"
                                    data-multiple-caption="{count} files selected" multiple />
                                <label class="box__dragndrop box__button justify-content-center">
                                    Limit data 1MB
                                    <br>
                                    Format: JPEG, PNG
                                </label>
                                <label for="file-back" class="upload-btn btn " style="cursor: pointer">Upload</label>
                            </div>
                            <div class="box__uploading">Uploading&hellip;</div>
                            <div class="box__success">Done!</div>
                            <div class="box__error">Error! <span></span>.</div>
                        </div>
                        <div class="d-flex justify-content-around mt-3">
                            <button data-dismiss="modal" class="btn button-cancel">Cancel</button>
                            <button class="add" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@stop