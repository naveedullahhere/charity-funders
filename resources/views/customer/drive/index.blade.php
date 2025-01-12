@extends('customer.layouts.master')
@section('title')
    My Drive
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>


    <style>
        .folder.card {
            background-color: #f0f4f9; /* Default background color */
            transition: background-color 0.3s ease; /* Smooth transition for background color */
            cursor: pointer;
            color: #444746 !important;
            font-weight: 600;
        }
        .folder.card  img{
           border-radius: 10px;
        }
        .folder.card  .foldertile{
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .folder.card:hover {
            background-color: #dfe3e7; /* Background color on hover */
        }
    </style>
    <div class="col-">
        <div class="card border-0 mb-4 shadow-sm">
            <div class="card-body p-lg-5">
                <div class="mb-3">
                    <h4 class="mb-1">My Drive</h4>
                </div>


                <div id="filteredData" class="row">

                </div>

            </div>
        </div>
    </div>


    {{--    filterationCommonDrive--}}

    <script>
        $('body').ready(function() {
            filterationCommonDrive(`{{ route('my-drive') }}`)
        });
    </script>
@endsection
