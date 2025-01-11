@extends('frontend.layouts.master')
@section('title', 'Gallery')
@section('meta_title', 'Gallery')
@section('meta_description', 'Gallery')
@section('meta_keyword', 'Gallery')
@section('content')
    <style>
        #function-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-select,
        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .input-group {
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .file-upload {
            position: relative;
            cursor: pointer;
            text-align: center;
            border: 2px dashed #007bff;
            border-radius: 5px;
            padding: 20px;
            background-color: #fff;
            transition: background-color 0.3s;
        }

        .file-upload:hover {
            background-color: #f0f8ff;
        }

        .file-upload img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .file-upload span {
            color: #007bff;
            font-weight: bold;
        }

        .form-control-file {
            display: none;
        }

        @media (max-width: 768px) {
            #function-box {
                padding: 15px;
            }
        }
    </style>
    <section id="page-banner" class="d-flex align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row position-relative">
                <div class="page-content col-md-8 mx-auto">
                    <div class="page-title">
                        <h2 class="text-uppercase text-white">
                            Gallery
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="Events" class="my-lg-5 my-md-2">
        <div class="container mt-lg-5">
            <div class="row" id="event-container">
                @include('frontend.pages._media', ['media' => $media, 'is_event' => 0])
            </div>

            @if ($media->hasMorePages())
                <div class="col-md-12 d-flex justify-content-center my-3">
                    <button type="button" class="load" id="load-more-event-btn" data-page="{{ $media->currentPage() }}">
                        Load More
                        <span class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </div>
            @endif

        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @include('frontend.pages.scripts')

    @include('frontend.pages.collections.index')
@endsection
