<script>
    let selectedMedia = []; // Declare it once here
    let selectedEvents = []; // Declare it once here

    $(document).ready(function() {

        function loadMore(buttonId, containerId) {
            $(buttonId).click(function() {
                let page = $(this).data('page');
                const button = $(this);

                button.find('.spinner-border').removeClass('d-none');

                $.ajax({
                    url: window.location.href,
                    method: 'GET',
                    data: {
                        page: page
                    },
                    success: function(response) {

                        const {
                            hasMorePages,
                            output
                        } = response;

                        const htmlResponse = $(output);

                        $(containerId).append(htmlResponse);

                        button.data('page', page + 1);
                        button.find('.spinner-border').addClass('d-none');
                        console.log({
                            response,
                            containerId
                        });

                        if (!hasMorePages) {
                            button.remove();
                        }
                    },
                    error: function(xhr) {
                        button.find('.spinner-border').addClass('d-none');
                        toastr.error("Failed to load more items.");
                    }
                });
            });
        }

        // Initialize for both events and galleries 
        loadMore('#load-more-gallery-btn', '#gallery-container');
        loadMore('#load-more-event-btn', '#event-container');

        // Handle media selection
        $('.select-media-checkbox').change(function() {
            let mediaId = $(this).data('id');
            let fileType = $(this).data('filetype');

            if ($(this).is(':checked')) {
                selectedMedia.push({
                    mediaId,
                    fileType
                });

                getPrices(mediaId, 'media', selectedMedia);
            } else {
                selectedMedia = selectedMedia.filter(item => item.mediaId !== mediaId);
                removeMediaPrices(mediaId, 'media', selectedMedia);
            }
        });

        // Handle event selection
        // $('.select-event-checkbox').change(function() {
        //     let eventId = $(this).data('id');
        //     if ($(this).is(':checked')) {
        //         selectedMedia.push({
        //             mediaId,
        //             fileType
        //         });

        //         getPrices(eventId, 'event', selectedMedia);
        //     } else {
        //         selectedEvents = selectedEvents.filter(item => item.id !== eventId);
        //         removeMediaPrices(eventId, 'event', selectedMedia);
        //     }
        // });

        function updateSelectedCount(type, count) {
            console.log(`${count} ${type} selected`);
            updateSelectedBar();
        }

        function updateSelectedBar() {
            $('#selected-count').text(selectedMedia.length);
            $('#selected-items-list').text(selectedMedia.length);
            if (selectedMedia.length > 0) {
                $('#selected-media-bar').addClass("visible");
            } else {
                $('#selected-media-bar').removeClass("visible");
            }
        }

        let imgPrice = 0;
        let videoPrice = 0;

        // Example function to add selected items to session
        function getPrices(id, type, selectedMedia = []) {

            checkAuthAndRedirect();

            // Initialize counters for videos and images
            let videoCount = 0;
            let imageCount = 0;

            // Iterate through the selectedMedia array and count based on fileType
            selectedMedia.forEach(media => {
                if (media.fileType === 'video') {
                    videoCount++;
                } else if (media.fileType === 'image') {
                    imageCount++;
                }
            });

            let mediaIds = selectedMedia.map(media => media.mediaId);

            $('input[name="media[]"]').val(mediaIds);

            $.post(`/collections/get-${type}-prices`, {
                    media_id: id, // Corrected field name
                    slug: '{{ $slug ?? 0 }}',
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {
                    if (response.status === 'success') {
                        // Assuming you want to display the prices
                        const {
                            price_per_video,
                            price_per_image,
                            whole_event_price
                        } = response.data;

                        const {
                            image_count,
                            video_count,
                            is_event
                        } = response;

                        videoCount = is_event === 1 ? video_count : videoCount;
                        imageCount = is_event === 1 ? image_count : imageCount;

                        imgPrice = price_per_image
                        videoPrice = price_per_video

                        document.getElementById('selected-count').textContent = videoCount +
                            imageCount; // Total items
                        document.getElementById('video-count').textContent = videoCount; // Video count
                        document.getElementById('image-count').textContent = imageCount; // Image count

                        if (is_event) {
                            document.getElementById('total-price').textContent = parseInt(whole_event_price)
                                .toFixed(2);
                        } else {
                            document.getElementById('total-price').textContent = ((price_per_video *
                                videoCount) + (price_per_image * imageCount)).toFixed(2);
                        }

                        // console.log("Price per video: " + data.price_per_video);
                        // console.log("Price per image: " + data.price_per_image);
                        // console.log("Price per high image: " + data.price_per_high_image);
                        // console.log("Price per high video: " + data.price_per_high_video);

                        // Example to update UI with the fetched prices
                        // $('#price-video').text(data.price_per_video);
                        // $('#price-image').text(data.price_per_image);
                        // $('#price-high-image').text(data.price_per_high_image);
                        // $('#price-high-video').text(data.price_per_high_video);
                    } else {
                        // alert("Failed to retrieve prices.");
                    }
                })
                .fail(function(e) {
                    console.log({
                        e
                    });
                }).always(function() {
                    updateSelectedCount(type, selectedMedia.length);
                });
        }

        function removeMediaPrices(id, type, selectedMedia = []) {

            checkAuthAndRedirect();

            // Initialize counters for videos and images
            let videoCount = 0;
            let imageCount = 0;

            // Iterate through the selectedMedia array and count based on fileType
            selectedMedia.forEach(media => {
                if (media.fileType === 'video') {
                    videoCount++;
                } else if (media.fileType === 'image') {
                    imageCount++;
                }
            });

            let mediaIds = selectedMedia.map(media => media.mediaId);

            $('input[name="media[]"]').val(mediaIds);

            document.getElementById('selected-count').textContent = videoCount +
                imageCount; // Total items
            document.getElementById('video-count').textContent = videoCount; // Video count
            document.getElementById('image-count').textContent = imageCount; // Image count
            document.getElementById('total-price').textContent = ((videoPrice *
                videoCount) + (imgPrice * imageCount)).toFixed(2);

            updateSelectedCount(type, selectedMedia.length);
        }
    });

    const checkAuthAndRedirect = () => {
        if (!('{{ auth()->check() }}')) {
            window.location = "/login";
        }
    }
</script>

<script>
    $(document).ready(function() {

        $(document).on('change', 'input[name="collection"]', function() {
            let selectedCollection = $(this).val();
            console.log("aa");

            $('#selected-collection').val(selectedCollection);
        });


        $('#proceed-btn').click(function() {
            $('#sideCanvas').addClass('show'); // Manually show the canvas if needed
            // updateSelectedBar(); // Update the selected items list when opening the canvas
        });

        $('#create-collection-form').submit(function(e) {
            e.preventDefault();
            let collectionName = $('#collection-name').val();

            $.post('{{ route('collections.store') }}', {
                    collection_name: collectionName,
                    _token: '{{ csrf_token() }}'
                })
                .done(function(response) {

                    const {
                        id,
                        name,
                        media
                    } = response;

                    let totalPrice = 0;
                    media.forEach(value => {
                        if (value.file_type === 'image') {
                            totalPrice += value.event && value.event.price_per_image ?
                                parseInt(value.event.price_per_image) : 0;
                        } else if (value.file_type === 'video') {
                            totalPrice += value.event && value.event.price_per_video ?
                                parseInt(value.event.price_per_video) : 0;
                        }
                    });

                    toastr.success("Collection created successfully!");

                    $('#collection-name').val('');

                    $('#existing-collections').append(`
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="collection" id="collection-${id}" value="${id}" checked>
                            <label class="form-check-label" for="collection-${id}">
                                ${name} (${totalPrice}$)
                            </label>
                        </div>
                    `);
                    // Automatically select the new collection
                    $(`#collection-${id}`).prop('checked', true).trigger('change');
                    // updateSelectedItemsList(); // Optionally refresh selected items list
                })
                .fail(function(jqXHR) {
                    let errorMessage = 'An error occurred.';
                    if (jqXHR.responseJSON && jqXHR.responseJSON.error) {
                        errorMessage = jqXHR.responseJSON.error;
                    }
                    toastr.success(errorMessage);
                });
        });
    });

    // function updateSelectedItemsList() {
    //     $('#selected-items-list').empty(); // Clear the list before updating
    //     selectedMedia.forEach(mediaId => {
    //         // Assuming you have a function to get media details by ID
    //         let mediaItem = getMediaById(mediaId); // Replace with actual implementation
    //         // $('#selected-items-list').append(
    //         //     `<li>${mediaItem.name}</li>`); // Assuming mediaItem has a name property
    //         $('#selected-items-list').text(selectedMedia.length);
    //     });

    //     // Update the selected count
    //     $('#selected-count').text(selectedMedia.length);
    //     if (selectedMedia.length > 0) {
    //         $('#selected-media-bar').show();
    //     } else {
    //         $('#selected-media-bar').hide();
    //     }
    // }

    function getMediaById(mediaId) {
        // Mock function to return media details. Replace this with actual logic to fetch media details.
        return {
            id: mediaId,
            name: `Media ${mediaId}`
        }; // Replace with your media data retrieval logic
    }
</script>
