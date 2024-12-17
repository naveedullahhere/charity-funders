@extends('management.layouts.master')
@section('title')
    Edit Gallery
@endsection
@section('content')
    @include('management.theme.includes.error_success')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.css"
        rel="stylesheet" />

    <div class="container-fluid px-4 pb-3">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <ul class="breadcrumb breadcrumb-style">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">Edit Gallery</h4>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <form id="subm" method="post" action="{{ route('gallery.update', $gallery->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="url" value="{{ route('gallery.index') }}">
                    <input type="hidden" id="uploaded_file_ids" name="uploaded_file_ids"
                        value="{{ implode(',', $gallery->media->pluck('id')->toArray()) }}">
                    <div class="row form-mar">
                        <!-- Gallery Name -->
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Gallery Name <span class="text-danger"> *</span></label>
                                <input type="text" name="name" class="form-control" value="{{ $gallery->name }}"
                                    placeholder="Gallery Name" required>
                            </div>
                        </div>

                        <!-- Event Dropdown -->
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Event <span class="text-danger"> *</span></label>
                                <select class="form-control" name="event_id" required>
                                    <option value="" disabled>Select Event</option>
                                    @foreach ($events as $event)
                                        <option value="{{ $event->id }}"
                                            {{ $event->id == $gallery->event_id ? 'selected' : '' }}>{{ $event->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Status Dropdown -->
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Status <span class="text-danger"> *</span></label>
                                <select class="form-control" name="status" required>
                                    <option value="1" {{ $gallery->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $gallery->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Media Upload -->
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Upload Media (Images/Videos)</label>
                                <input type="file" name="file[]" class="filepond" multiple data-max-file-size="10MB"
                                    data-max-files="10" accept="image/*,video/*">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row text-center center">
                        <div class="col-12">
                            <button type="submit" id="save-gallery" class="btn btn-primary">Save Gallery</button>
                            <button type="button" class="btn btn-danger" data-close="model">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            uploadedFileIds = @json($gallery->media->pluck('id')->toArray());

            let totalFiles = 0;
            let processedFiles = 0;

            // Register FilePond plugins
            FilePond.registerPlugin(
                FilePondPluginImagePreview, // Image preview plugin
                FilePondPluginMediaPreview // Video preview plugin
            );

            // Initialize FilePond
            const inputElement = document.querySelector('.filepond');
            const saveButton = document.getElementById('save-gallery');
            const cancelButton = document.getElementById('cancel-gallery');
            const existingMedia = @json($existingMedia);
            const pond = FilePond.create(inputElement, {
                files: existingMedia,
                allowFilePoster: true,
                onerror: (error) => console.log('FilePond Error:', error),
                onprocessfile: (error, file) => {
                    if (error) {
                        console.log('FilePond Process Error:', error);
                    } else {
                        console.log('FilePond File Processed:', file);
                    }
                },
                onaddfile: (fileItem) => {
                    totalFiles += 1;
                    console.log('Total Files:', totalFiles);
                },

                onaddfilestart: (fileItem) => {
                    saveButton.disabled = true;
                    // cancelButton.disabled = true;
                },

                onprocessfile: (fileItem) => {
                    processedFiles += 1;
                    console.log('Processed Files:', processedFiles);

                    if (processedFiles === totalFiles) {
                        saveButton.disabled = false;
                        // cancelButton.disabled = false;
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
                        // cancelButton.disabled = false;
                    }
                }
            });

            // Load existing media into FilePond 
            existingMedia.forEach(file => {

                // pond.addFile(file.source);
                // pond.addFile({
                //     source: file.source,
                //     type: file.options.type,
                //     file: file.options.file,
                //     metadata: file.options.metadata
                // }).catch(error => {
                //     console.error('FilePond error:', error);
                // });
            });

            // FilePond server options for new file uploads
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
                            uploadedFileIds.push(...data.fileIds);

                            return JSON.stringify({
                                media_ids: data.fileIds,
                                media_id: 1
                            });
                        },
                    },
                    _revert: {
                        url: '/admin/revert-media',
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: (fileId) => {
                            return JSON.stringify({
                                media_ids: [fileId], // Wrapping fileId in an array with the key 'media_ids'
                                media_id: 1 // Adding a static or dynamic media_id
                            });
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if (data && data.media_ids && data.status && data.status === "success") {
                                const index = uploadedFileIds.indexOf(data.media_ids);
                                if (index > -1) {
                                    uploadedFileIds.splice(index, 1);
                                }
                            }
                        }

                    },
                    revert: (uniqueFileId, load, error) => {
                        console.log({
                            uniqueFileId
                        });

                        let payload;
                        if (typeof uniqueFileId === 'string' && uniqueFileId.startsWith("{")) {
                            // If it's already a JSON string, parse it and use it as-is
                            payload = JSON.parse(uniqueFileId);
                        } else {
                            // Otherwise, treat it as a plain ID and wrap it in a JSON structure
                            payload = {
                                media_ids: [uniqueFileId], // Wrap the ID in an array with the key 'media_ids'
                                media_id: 1 // Add a static or dynamic media_id
                            };
                        }

                        // Send request using Fetch API
                        fetch('/admin/revert-media', {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(payload) // Convert payload to JSON string
                            })
                            .then(response => response.json()) // Assuming server responds with JSON
                            .then(data => {
                                console.log(data);

                                // Call the load method when done
                                if (data.status === "success") {

                                    if (data && data.media_ids && data.status && data.status === "success") {
                                        const index = uploadedFileIds.indexOf(data.media_ids);
                                        if (index > -1) {
                                            uploadedFileIds.splice(index, 1);
                                        }
                                    }
                                    console.log({
                                        data
                                    });

                                    load();
                                } else {
                                    error('Failed to revert media');
                                }
                            })
                            .catch(err => {
                                console.error(err);
                                error('Error reverting media');
                            });
                    }


                },
                name: 'file[]'
            });

            // Handle form submission via AJAX
            // document.getElementById('save-gallery').addEventListener('click', function(e) {
            //     e.preventDefault();

            //     document.getElementById('uploaded_file_ids').value = uploadedFileIds.flat().join(",");
            //     const formData = new FormData(document.getElementById('gallery-form'));

            //     fetch('{{ route('gallery.update', $gallery->id) }}', {
            //             method: 'POST',
            //             headers: {
            //                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
            //                 'Accept': 'application/json',
            //             },
            //             body: formData
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             if (data.success) {
            //                 alert('Gallery updated successfully!');
            //                 window.location.href = '{{ route('gallery.index') }}';
            //             } else {
            //                 alert('Error updating the gallery.');
            //             }
            //         })
            //         .catch(error => {
            //             console.error('Error:', error);
            //             alert('An unexpected error occurred.');
            //         });
            // });
        </script>
    @endsection
