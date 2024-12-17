@extends('frontend.layouts.master')
@section('title', 'Home')
@section('meta_title', 'Home')
@section('meta_description', 'Home')
@section('meta_keyword', 'Home')
@section('content')
    <style>
        /*.custom-inp {*/
        /*    border-radius: 12px !important;*/
        /*    overflow: hidden;*/
        /*}*/

        /*.custom-inp :is(.form-select, .form-control),*/
        /*.custom-inp.form-select {*/
        /*    padding-block: 8px !important;*/
        /*}*/

        /*.input-group-text {*/
        /*    padding-block: 10px !important;*/
        /*}*/
    </style>
    <!-- section one start -->
    <section id="function-box" class="d-flex align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row position-relative" id="formRow">
                <!-- Loading overlay -->
                <div id="loadingOverlay"
                    class="d-none position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                    style="background: rgba(255, 255, 255, 0.8); z-index: 10;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <!-- Form fields -->
                <div class="col-md-2 px-md-0">
                    <select class="form-select h-100 form-select-lg custom-inp" aria-label=".form-select-lg example">
                        <option value="" selected disabled>Select Event</option>
                        @foreach ($allEvents as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 px-md-0">
                    <div class="input-group h-100 custom-inp">
                        <div class="input-group-prepend">
                            <span class="input-group-text h-100" id="basic-addon1">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Find an Event" aria-label="Find an Event"
                            aria-describedby="Find-a-Event">
                    </div>
                </div>
                <div class="col-md-3 px-md-0">
                    <div class="form-group camera mx-md-2">
                        <div class="file-upload" id="file-upload">
                            <label style="font-size: 10px" for="file-input" class="file-upload-label">
                                <span>Drag & Drop or Click to Upload Image</span>
                            </label>
                            <input type="file" id="file-input" class="form-control-file" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 px-md-0">
                    <button id="submitForm" type="button" class="w-100 btn btn-dark h-100 rounded-0">Submit</button>
                </div>
                <form id="hiddenForm" action="{{ route('final-submit') }}" method="POST" style="display:none;">
                    @csrf
                    <input type="hidden" name="event_id" id="hiddenEventId">
                    <input type="hidden" name="event_name" id="hiddenEventName">
                    <input type="hidden" name="image_data" id="hiddenImageData">
                </form>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('submitForm').addEventListener('click', function() {
            const selectedEventId = document.querySelector('select').value;
            const searchQuery = document.querySelector('input[type="text"]').value;
            const fileInput = document.getElementById('file-input');

            document.getElementById('loadingOverlay').classList.remove('d-none');

            let formData = new FormData();
            formData.append('event_id', selectedEventId);
            formData.append('search_query', searchQuery);
            if (fileInput.files.length > 0) {
                formData.append('image', fileInput.files[0]);
            }

            fetch('{{ route('handle-ajax-request') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('hiddenEventId').value = data.event_id;
                        document.getElementById('hiddenEventName').value = data.event_name;
                        document.getElementById('hiddenImageData').value = JSON.stringify(data.image_data);

                        document.getElementById('hiddenForm').submit();
                    } else {
                        alert('An error occurred while processing your request.');
                    }
                })
                .catch(error => console.error('Error:', error))
                .finally(() => {
                    document.getElementById('loadingOverlay').classList.add('d-none');
                });
        });
    </script>

    <style>
        div#formRow {
            background: #ffffffab;
            padding: 15px;
            backdrop-filter: blur(5px); /* Adjust the blur intensity as needed */
        }
        #function-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /*.form-select,*/
        /*.form-control {*/
        /*    border: 1px solid #ccc;*/
        /*    border-radius: 5px;*/
        /*    transition: border-color 0.3s;*/
        /*}*/

        div#formRow .form-select
       {
            border-right: 2px solid #ccc;
            padding-left: 16px !important;
        }
        .form-select:focus,
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /*.input-group {*/
        /*    border: 1px solid #ccc;*/
        /*    border-radius: 5px;*/
        /*}*/

        .file-upload {
            position: relative;
            cursor: pointer;
            text-align: center;
            border: 2px dashed #000000;
            /*border-radius: 5px;*/
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
            color: #000000;
            font-weight: bold;
        }

        .form-control-file {
            display: none;
            /* Hide the default file input */
        }

        /* Add some responsiveness */
        @media (max-width: 768px) {
            #function-box {
                padding: 15px;
            }
        }
    </style>

    <script>
        // Drag and drop functionality
        const fileUpload = document.getElementById('file-upload');
        const fileInput = document.getElementById('file-input');

        fileUpload.addEventListener('click', function() {
            fileInput.click();
        });

        fileUpload.addEventListener('dragover', function(e) {
            e.preventDefault();
            fileUpload.style.backgroundColor = '#e0e7ff'; // Light blue on hover
        });

        fileUpload.addEventListener('dragleave', function() {
            fileUpload.style.backgroundColor = ''; // Reset to original
        });

        fileUpload.addEventListener('drop', function(e) {
            e.preventDefault();
            fileUpload.style.backgroundColor = ''; // Reset to original
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files; // Set the files to the input
            }
        });
    </script>

    <!-- events section start -->
    <section id="Events" class="my-lg-5 my-md-2">
        <div class="container mt-lg-5">
            <div class="row">
                <div class="col-12 objectives d-flex justify-content-between">
                    <h1 class="text-uppercase">All Events</h1>
                </div>
            </div>
            <div class="row" id="event-container">
                @include('frontend.pages._media', ['media' => $events, 'is_event' => 1])
            </div>

            @if ($events->hasMorePages())
                <div class="col-md-12 d-flex justify-content-center my-3">
                    <button type="button" class="load" id="load-more-event-btn" data-page="{{ $events->currentPage() }}">
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
