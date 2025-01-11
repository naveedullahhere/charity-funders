@extends('management/layouts/master')
@section('title')
    Business Profile
@endsection
@section('content')
    <style>
        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        .upload__btn {
            display: flex;
            font-weight: 600;
            color: #BC9C5B;
            text-align: center;
            width: 200px;
            height: 178px;
            padding: 30px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: transparent;
            border: 2px dashed #BC9C5B !important;
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
            /* margin: auto !important; */
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            margin-bottom: 12px;
        }
        .upload__btn:hover {
            background-color: #BC9C5B;
            color: #000;
            transition: all 0.3s ease;
        }
        .upload__btn-box {
            margin-bottom: 10px;
        }
        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }
        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }
        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
        }
        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }



        .svg-shadow {
            text-align: center;
            background: white;
            box-shadow: 2px 1px 9px -1px #8080804f;
            padding: 15px 0px 15px 0px;
            border-radius: 10px;
        }

    </style>
    @include('management.theme.includes.error_success')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <form class="example" id="subm" method="post" action="{{route('business-profile.store')}}">
                    @csrf
                    <input type="hidden" id="url" value="{{ route('business-profile.index') }}"/>
                    <div class="row form-mar">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label class="mb-2">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="upload__box">
                                <div class="upload__btn-box text-center">
                                    <div class="upload__img-wrap">
                                        <label class="upload__btn">
                                            <p class="m-0">Upload images</p>
                                            <input type="file" data-max_length="20" name="header_image" class="upload__inputfile">
                                        </label>
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label class="mb-2">Website Link</label>
                                <input type="text" name="website" class="form-control" placeholder="Website Link">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label class="mb-2">Youtube Link</label>
                                <input type="text" name="youtube_link" class="form-control" placeholder="Youtube Link">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label class="mb-2">Description</label>
                                <textarea name="description" id="editor"></textarea>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="upload__box">
                                <div class="upload__btn-box text-center">
                                    <div class="upload__img-wrap">
                                        <label class="upload__btn">
                                            <p class="m-0">Upload images</p>
                                            <input type="file" multiple="" data-max_length="20" name="image[]" class="upload__inputfile">
                                        </label>
                                    </div>

                                </div>
                            </div>


                        </div>


                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Attachment</label>
                                <input type="file" name="attachments" class="form-control" placeholder="Description">
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12">
                            <button type="submit" class="btn-theme">Save</button>
                            <button type="button" class="btn-white" data-close="model">Cancel</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>




        jQuery(document).ready(function () {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function () {
                $(this).on('change', function (e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function (f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.prepend(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function (e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script>

@endsection
