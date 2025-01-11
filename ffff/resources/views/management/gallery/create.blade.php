@extends('management.layouts.master')
@section('title')
    Gallery
@endsection
@section('content')
    @include('management.theme.includes.error_success')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.css"
        rel="stylesheet" />
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>

    <style> 

        .filepond--item {
            width: calc(25% - 0.5em);
        }

        body {
            padding: 2em;
        }

        img {
            margin: 1em 2em 0 0;
            border-radius: .25em;
            box-shadow: 0 .125em .5em rgba(0, 0, 0, .25);
        }
    </style>

    <div class="container-fluid px-4 pb-3">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <ul class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">Gallery</h4>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <form id="subm" method="post" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="url" value="{{ route('gallery.index') }}">
                    <div class="row form-mar">
                        <!-- Gallery Name -->
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Gallery Name <span class="text-danger"> *</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Gallery Name">
                            </div>
                        </div>

                        <!-- Event Dropdown -->
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Event <span class="text-danger"> *</span></label>
                                <select class="form-control" name="event_id">
                                    <option value="" selected disabled>Select Event</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Status Dropdown -->
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Status <span class="text-danger"> *</span></label>
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Media Upload -->
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Upload Media (Images/Videos) <span class="text-danger"> *</span></label>
                                <input type="file" name="file[]" class="filepond" multiple data-max-file-size="100000MB"
                                    data-max-files="100000" accept="image/*,video/*">
                                <input type="hidden" id="uploaded_file_ids" name="uploaded_file_ids" value="">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row text-center center">
                        <div class="col-12">
                            <button type="submit" id="save-gallery" class="btn btn-primary">Save Gallery</button>
                            <button type="button" id="cancel-gallery" class="btn btn-danger"
                                data-close="model">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            console.clear()

            const saveButton = document.getElementById('save-gallery');
            const cancelButton = document.getElementById('cancel-gallery');
            const inputElement = document.querySelector('.filepond');
            let totalFiles = 0;
            let processedFiles = 0;

            // Register FilePond plugins
            FilePond.registerPlugin(
                FilePondPluginImagePreview, // Image preview plugin
                FilePondPluginMediaPreview, // Video preview plugin
                FilePondPluginImageResize
            );

            // Initialize FilePond
            const pond = FilePond.create(inputElement, {
                imageCropAspectRatio: 1,
                imageResizeTargetWidth: 256,
                imageResizeMode: 'contain',
                onaddfile: (fileItem) => {
                    totalFiles += 1;
                    console.log('Total Files:', totalFiles);
                },

                onaddfilestart: (fileItem) => {
                    saveButton.disabled = true;
                    cancelButton.disabled = true;
                },

                onprocessfile: (fileItem) => {
                    processedFiles += 1;
                    console.log('Processed Files:', processedFiles);

                    if (processedFiles === totalFiles) {
                        saveButton.disabled = false;
                        cancelButton.disabled = false;
                    }
                },

                onprocessfileprogress: (fileItem, progress) => {},

                onremovefile: (fileItem) => {
                    totalFiles -= 1;

                    if (processedFiles > totalFiles) {
                        processedFiles = totalFiles;
                    }

                    if (processedFiles === totalFiles) {
                        saveButton.disabled = false;
                        cancelButton.disabled = false;
                    }
                }
            });

            // FilePond server options
            pond.setOptions({
                server: {
                    process: {
                        url: '/admin/upload-media',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);

                            uploadedFileIds.push(data.fileIds);

                            return JSON.stringify({
                                media_ids: data.fileIds,
                                media_id: 1
                            });
                        },
                        onerror: () => {}
                    },
                    revert: {
                        url: '/admin/revert-media',
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);

                            if (data && data.media_ids && data.status && data.status === "success") {
                                // Find the index of the array that matches data.media_ids
                                const index = uploadedFileIds.findIndex(idsArray => JSON.stringify(idsArray) ===
                                    JSON.stringify(data.media_ids));

                                // If the index is found, remove the corresponding array
                                if (index > -1) {
                                    uploadedFileIds.splice(index,
                                        1); // Remove the media ID array from the array of arrays
                                }
                            }
                        },
                    }
                },
                name: 'file[]' // Ensure name is an array for multiple files
            });
        </script>
    @endsection
