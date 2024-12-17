<footer class="mt-3 py-3">
    <div class="container mt-lg-3">
        <div class="image mt-lg-3 d-flex justify-content-center align-items-center">
            <img class="img-fluid" src="{{ asset('ajpfrontend/images/logo.svg') }}" alt="">
        </div>
        <div class="copyright d-flex justify-content-center align-items-center">
            <p class="footer-text text-uppercase">Copyright © 2024 AJP. All rights reserved.
            </p>
        </div>
        <div class="double d-flex justify-content-center">
            <button type="button" class="me-2 terms">Terms of Service
            </button>
            <button type="button" class="terms">Privacy Policy</button>
        </div>
    </div>
</footer>

<div class="clear"></div>

<div class="btn-scroll-top">
    <svg class="progress-square svg-content" width="100%" height="100%" viewBox="0 0 40 40">
        <path
            d="M8 1H32C35.866 1 39 4.13401 39 8V32C39 35.866 35.866 39 32 39H8C4.13401 39 1 35.866 1 32V8C1 4.13401 4.13401 1 8 1Z" />
    </svg>
</div>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<!-- Libs JS -->
<script src="{{ asset('frontend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/headhesive/dist/headhesive.min.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('frontend/assets/js/theme.min.js') }}"></script>

<script src="{{ asset('frontend/assets/libs/jarallax/dist/jarallax.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendors/jarallax.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/parallax-js/dist/parallax.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendors/parallax.js') }}"></script>
<!-- Swiper JS -->
<script src="{{ asset('frontend/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendors/swiper.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/glightbox/dist/js/glightbox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendors/glight.js') }}"></script>
<script src="{{ asset('frontend/assets/libs/scrollcue/scrollCue.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendors/scrollcue.js') }}"></script>
<script src="{{ asset('assets/js/get_ajax_data.js') }}"></script>
<script src="{{ asset('assets/js/form_submit.js') }}"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('discountSec')

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function addToCart(e, itemId, itemType, defaultPrice, quantity = 1) {
        let price = defaultPrice;
        let quality = 'standard';
        $(e).attr("disabled", true);

        if (itemType === 'collection' || itemType === 'media') {
            const selectedQuality = document.querySelector('input[name="media_quality"]:checked');
            if (selectedQuality) {
                const value = selectedQuality.value.split('|');
                quality = value[0]; // Either 'standard' or 'high'
                price = value[1] ? value[1] : defaultPrice; // If 'high', get the high price
            } else {
                toastr.error("Quality field is required!");
                $(e).attr("disabled", false); // Re-enable button if quality is not selected
                return;
            }
        }

        $.ajax({
            url: '{{ route('basket.add') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                item_id: itemId,
                item_type: itemType,
                price,
                quality,
                quantity
            },
            success: function(response) {
                if (response.success) {
                    updateItemCount(response.itemCount);
                    toastr.success("Added to cart.");

                    // Change the button to "Remove from Cart"
                    // $(e).attr("disabled", false);

                } else {
                    toastr.error("Something went wrong!");
                    $(e).attr("disabled", false); // Re-enable button if there's an error
                }
            },
            error: function(xhr) {
                toastr.error("Something went wrong!");
                $(e).attr("disabled", false); // Re-enable button if there's an error
            }
        });
    }

    function updateItemCount(count) {
        const cartElements = document.getElementsByClassName('cart-count');

        for (let i = 0; i < cartElements.length; i++) {
            cartElements[i].innerText = count;
        }
    }

    function removeFromCart(e, basketItemId) {
        var cartItem = $(e).closest('.cart-item');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to remove this item from your cart?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/cart/remove/' + basketItemId,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update total price and item count
                            updateItemCount(response.itemCount || 0);
                            $('#totalPrice').text((response.newTotal).toFixed(2));

                            // Change button back to "Add to Cart"
                            $(e).text('Add to Cart')
                                .off('click')
                                .on('click', function() {
                                    addToCart(e, itemId, itemType, defaultPrice, quantity);
                                });

                            toastr.success("Item removed from cart.");
                        } else {
                            toastr.error("Could not remove the item.");
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        toastr.error("Something went wrong!");
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        $('.delete-item').on('click', function() {
            var itemId = $(this).data('id');
            var cartItem = $(this).closest('.cart-item');

            $.ajax({
                url: '/cart/remove/' + itemId,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    response.newTotal = parseInt(response.newTotal);

                    if (typeof response.newTotal === 'number') {
                        cartItem.remove();
                        updateItemCount(response.itemCount || 0);

                        $('#totalPrice').text((response.newTotal)
                            .toFixed(2));

                        toastr.success("The item has been removed.");
                    } else {
                        toastr.error("Invalid total price returned by the server.");
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("Something went wrong. Please try again later.");
                }
            });
        });
    });
</script>

<script>
    // Function to format date to YYYY-MM-DDTHH:MM
    function formatDateToInputValue(date) {
        const offset = date.getTimezoneOffset();
        const localDate = new Date(date.getTime() - (offset * 60 * 1000));
        return localDate.toISOString().slice(0, 16);
    }

    // Function to set default end date and minimum selectable date for the end date input
    function setDefaultEndDate() {
        // Get the "Arrival date" input element
        var arrivalDateInput = document.getElementById("arrival_date");

        // Get the "Return date/time" input element
        var returnDateInput = document.getElementById("return_date");

        if (arrivalDateInput) {
            // Get the selected arrival date
            var arrivalDate = new Date(arrivalDateInput.value);
        }

        if (arrivalDate) {

            // Calculate the default end date (10 days after the selected "Arrival date")
            var defaultEndDate = new Date(arrivalDate.getTime() + 10 * 24 * 60 * 60 * 1000);
            var defaultEndDateString = formatDateToInputValue(defaultEndDate);

            // Update the default value and min attribute for "Return date/time" input
            returnDateInput.value = defaultEndDateString;

            // Set the min attribute for "Return date/time" input to the selected "Arrival date"
            var minReturnDateString = formatDateToInputValue(arrivalDate);
            returnDateInput.min = minReturnDateString;
        }
    }

    // Add a window load event listener
    window.addEventListener("load", function() {
        // Get the current date and time
        var currentDate = new Date();

        // Format the current date as a string in the required format
        var currentDateString = formatDateToInputValue(currentDate);

        // Get the "Arrival date" input element
        var arrivalDateInput = document.getElementById("arrival_date");

        if (arrivalDateInput) {
            // Set the default value of the "Arrival date" input to the current date
            arrivalDateInput.value = currentDateString;

            // Set the min attribute of the "Arrival date" input to the current date
            arrivalDateInput.min = currentDateString;

            // Add an event listener to the "Arrival date" input to update the default end date and min attribute for "Return date/time" input
            arrivalDateInput.addEventListener("change", function() {
                // Call the function to set the default end date and minimum selectable date for the end date input
                setDefaultEndDate();
            });
        }

        // Get the "Return date/time" input element
        var returnDateInput = document.getElementById("return_date");

        // Call the function to set the default end date and minimum selectable date for the end date input
        setDefaultEndDate();

    });



    $(".book-now-button").each((idx, _) => {
        $(_).click(({
            target
        }) => {
            $(target).html(`
            <div class="spinner-border text-white" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        `);

            let productId = $(event.target).parent("div").find("[name=id]").val();
            let productPrice = $(event.target).parent("div").find("[name=price]").val();

            setTimeout(() => {
                let url = "{{ route('addToCart') }}?product_id=" + productId +
                    "&arrival_date={{ $arrival_date ?? '' }}&return_date={{ $return_date ?? '' }}&product_price=" +
                    productPrice;

                window.location.href = url;
                $(event.target).html(`Book Now`);
            }, 2000);
        });
    });

    $(document).ready(function() {
        var debounceTimer; // Variable to store the timer ID

        $('#subscribeForm').submit(function(event) {
            event.preventDefault();

            // Clear the previous timer
            clearTimeout(debounceTimer);

            // Show the spinner
            $('#submitButton .spinner-border').removeClass('d-none');

            // Set a new timer to delay the form submission by 300 milliseconds
            debounceTimer = setTimeout(function() {
                var formData = $('#subscribeForm').serialize();

                $.ajax({
                    url: '{{ route('subscribe') }}',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        toastr.success(response.success);
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON;
                        var errorMessage = '';

                        if (errors.errors) {
                            $.each(errors.errors, function(key, value) {
                                errorMessage += value[0];
                            });
                        } else {
                            errorMessage = errors.message;
                        }

                        toastr.error(errorMessage);
                    },
                    complete: function() {
                        // Hide the spinner when the request is complete
                        $('#submitButton .spinner-border').addClass('d-none');
                    }
                });
            }, 300);
        });
    });






    function filterationCommonDrive(url, loadmore = false, appenddiv = "filteredData") {
        var url = url;
        var loadmore = loadmore;
        var appenddiv = appenddiv;




        $('#' + appenddiv).html(`<div class="text-center spinnerparent"><div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status"></div></div>`);

        // Initialize Daterangepicker
        initializeDaterangepicker();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#filterForm input, #filterForm select').on('change keyup', function () {
            $('#' + appenddiv).html(`<div class="text-center spinnerparent"><div class="spinner-border" role="status"></div></div>`);
            var formData = $('#filterForm').serialize();
            fetch_data(formData);
        });

        $(document).on('click', '#paginationLinks a', function (e) {
            $('#' + appenddiv).html(`<div class="text-center spinnerparent"><div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status"></div>`);
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            var formData = $('#filterForm').serialize() + '&page=' + page;
            fetch_data(formData);
        });

        // Track the page number for loading more
        let isLoading = false;

        // On scroll load more
        $(window).on('scroll', function () {
            var currentPage = $('#currentPage').val();  // Use passed currentPage
            var totalPages =  $('#totalPages').val();  // Use passed totalPages

            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !isLoading && currentPage < totalPages) {
                isLoading = true;

                currentPage++;
                var formData = $('#filterForm').serialize() + '&page=' + currentPage;
                load_more_data(formData, true);
                $('#currentPage').remove()
                $('#totalPages').remove()
            }
        });

        function fetch_data(formData) {
            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function (data) {
                    $('#' + appenddiv).html(data);

                    // Reinitialize Daterangepicker after AJAX content is loaded
                    initializeDaterangepicker();

                    // Reset loading state
                    isLoading = false;
                },
                error: function (xhr, status, error) {
                    console.error(error);

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong: ' + xhr.status + ' ' + error,
                        confirmButtonColor: '#3085d6'
                    });

                    // Reset loading state
                    isLoading = false;
                }
            });
        }

        function load_more_data(formData, append = false) {
            $('#' + appenddiv).append(`<div class="text-center spinnerparent"><div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status"></div></div>`);

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function (data) {
                    if (append) {
                        $('#' + appenddiv).append(data);
                    } else {
                        $('#' + appenddiv).html(data);
                    }

                    initializeDaterangepicker();
                    $('#' + appenddiv).find('.spinnerparent').remove();
                    isLoading = false;
                },
                error: function (xhr, status, error) {
                    console.error(error);

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong: ' + xhr.status + ' ' + error,
                        confirmButtonColor: '#3085d6'
                    });

                    isLoading = false;
                }
            });
        }

        // Initialize the page when loading
        fetch_data($('#filterForm').serialize());

        function initializeDaterangepicker() {
            try {
                if ($('#date_range').length) {
                    var currentDate = moment().add(1, 'days');
                    var startDate = moment().subtract(28, 'days');

                    $('#date_range').daterangepicker({
                        startDate: startDate,
                        endDate: currentDate,
                        autoUpdateInput: false,
                        locale: {
                            cancelLabel: 'Clear Date & All'
                        }
                    });

                    $('#date_range').val(startDate.format('YYYY-MM-DD') + ' - ' + currentDate.format('YYYY-MM-DD'));

                    $('#date_range').on('apply.daterangepicker', function (ev, picker) {
                        $('#' + appenddiv).html(`<div class="text-center spinnerparent"><div class="spinner-border" role="status"></div></div>`);
                        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                        fetch_data($('#filterForm').serialize());
                    });

                    $('#date_range').on('cancel.daterangepicker', function (ev, picker) {
                        $('#' + appenddiv).html(`<div class="text-center spinnerparent"><div class="spinner-border" role="status"></div></div>`);
                        $(this).val('');
                        fetch_data($('#filterForm').serialize());
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Initialization Error',
                    text: 'An error occurred while initializing the date range picker: ' + error.message,
                    confirmButtonColor: '#3085d6'
                });
            }
        }
    }





</script>
