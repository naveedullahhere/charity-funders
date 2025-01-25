// function filterationCommon(url, loadmore = false, appenddiv = "filteredData") {
//   renderLoadingTable("#filteredData table", 10);
// }

// renderLoadingTable("#filteredData table", 12);

function filterationCommon(url, loadmore = false, appenddiv = "filteredData") {
  renderLoadingTable("#filteredData table", 10);

  var url = url;
  var loadmore = loadmore;
  var appenddiv = appenddiv;

  // Initialize Daterangepicker
  initializeDaterangepicker();

  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  // Debounce function to optimize input change handling
  function debounce(func, delay) {
    let timer;
    return function (...args) {
      clearTimeout(timer);
      timer = setTimeout(() => func.apply(this, args), delay);
    };
  }

  // Handle form input changes
  $("#filterForm input, #filterForm select")
    .off("change keyup")
    .on(
      "change keyup",
      debounce(function (event) {
        var $this = $(this);

        // If the input has the class 'only-keypress', skip change event
        if ($this.attr("type") === "text" && event.type !== "keyup") {
          return;
        }

        renderLoadingTable("#filteredData table", 12);
        var formData = $("#filterForm").serialize();
        updateUrlParams(formData);
        fetch_data(formData);
      }, 300)
    );

  // Handle pagination
  $(document).on("click", "#paginationLinks a", function (e) {
    renderLoadingTable("#filteredData table", 12);
    e.preventDefault();
    var page = $(this).attr("href").split("page=")[1];
    var formData = $("#filterForm").serialize() + "&page=" + page;
    updateUrlParams(formData);
    fetch_data(formData);
  });
  $(document).on("change", "#per_page ", function (e) {
    renderLoadingTable("#filteredData table", 12);
    e.preventDefault();
    var page = $(this).val();
    var formData = $("#filterForm").serialize() + "&per_page=" + page;
    updateUrlParams(formData);
    fetch_data(formData);
  });

  // Fetch data with AJAX
  function fetch_data(formData) {
    $.ajax({
      url: url,
      type: "POST",
      data: formData,
      success: function (data) {
        $("#" + appenddiv).html(data);

        // Reinitialize Daterangepicker after AJAX content is loaded
        initializeDaterangepicker();
      },
      error: function (xhr, status, error) {
        console.error(error);
        handleAjaxError(xhr, status, error);

        // Swal.fire({
        //   icon: "error",
        //   title: "Error",
        //   text: "Something went wrong: " + xhr.status + " " + error,
        //   confirmButtonColor: "#3085d6",
        // });
      },
    });
  }

  // Update URL parameters
  function updateUrlParams(formData) {
    const urlParams = new URLSearchParams(formData);
    const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
    window.history.pushState(null, "", newUrl);
  }

  // // Load filter values from URL on page load
  // function loadFiltersFromUrl() {
  //   const urlParams = new URLSearchParams(window.location.search);
  //   urlParams.forEach((value, key) => {
  //     const $field = $(`[name="${key}"]`);
  //     if ($field.length) {
  //       if ($field.is(":checkbox")) {
  //         $field.prop("checked", value === "true");
  //       } else if ($field.is(":radio")) {
  //         $field.filter(`[value="${value}"]`).prop("checked", true);
  //       } else {
  //         $field.val(value).trigger("change");
  //       }
  //     }
  //   });
  // }

  // Initialize filters on page load
  // loadFiltersFromUrl();
  fetch_data($("#filterForm").serialize());

  // Initialize Daterangepicker
  function initializeDaterangepicker() {
    try {
      if ($("#date_range").length) {
        var currentDate = moment().add(1, "days");
        var startDate = moment().subtract(28, "days");

        $("#date_range").daterangepicker({
          startDate: startDate,
          endDate: currentDate,
          autoUpdateInput: false,
          locale: {
            cancelLabel: "Clear Date & All",
          },
        });

        $("#date_range").val(
          startDate.format("YYYY-MM-DD") +
            " - " +
            currentDate.format("YYYY-MM-DD")
        );

        $("#date_range").on("apply.daterangepicker", function (ev, picker) {
          $(this).val(
            picker.startDate.format("YYYY-MM-DD") +
              " - " +
              picker.endDate.format("YYYY-MM-DD")
          );
          var formData = $("#filterForm").serialize();
          updateUrlParams(formData);
          fetch_data(formData);
        });

        $("#date_range").on("cancel.daterangepicker", function (ev, picker) {
          $(this).val("");
          var formData = $("#filterForm").serialize();
          updateUrlParams(formData);
          fetch_data(formData);
        });
      }
    } catch (error) {
      console.error(error);
      Swal.fire({
        icon: "error",
        title: "Initialization Error",
        text:
          "An error occurred while initializing the date range picker: " +
          error.message,
        confirmButtonColor: "#3085d6",
      });
    }
  }
}

$(document).on("submit", "#ajaxSubmit", function (e) {
  var formhunyr = $(this);

  e.preventDefault(); // Avoid executing the actual submit of the form.

  // Clear previous errors and success messages
  $(".print-error-msg").find("ul").html("");
  $(".alert-success").find("ul").html("");

  var form = $(this);
  var actionUrl = form.attr("action");

  var formData = new FormData(form[0]);

  // Process 'notes' field if value is '1'
  var notesValue = formData.get("notes");
  if (notesValue == 1) {
    var editorElement = document.querySelector(".ql-editor");
    var textContent = editorElement.innerHTML;
    formData.append("notes", textContent);
  }

  // Remove any previous error styling and messages
  $(".error-message").remove();
  $(".is-invalid").removeClass("is-invalid");

  // Display SweetAlert loader
  Swal.fire({
    title: "Processing",
    text: "Please wait...",
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });

  // AJAX request
  $.ajax({
    type: "POST",
    url: actionUrl,
    data: formData,
    processData: false,
    contentType: false,

    success: function (data) {
      Swal.close(); // Close loader

      if (data.catchError) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: data.catchError,
          confirmButtonColor: "#D95000",
        });
      } else if ($.isEmptyObject(data.error)) {
        Swal.fire({
          icon: "success",
          title: "Success",
          text: data.success,
          confirmButtonColor: "#3085d6",
        }).then((result) => {
          if (result.isConfirmed) {
            // Further actions after the user clicks "Okay"
            if (form.data("reset") === true) {
              form[0].reset(); // Reset the form without trigger
            }
            // Handle redirection or list refresh
            var url = form.find("#url").val();
            var listRefresh = form.find("#listRefresh").val();
            var ajaxLoadFlag = form.find("#ajaxLoadFlag").val();
            $(formhunyr).parents(".modal-sidebar").removeClass("open");
            $(".main-content").css("cursor", "auto");
            console.log(listRefresh);

            if (url) {
              window.location.href = url;
            }
            if (listRefresh) {
              console.log({ listRefresh });
              filterationCommon(listRefresh);
              $(formhunyr).parents(".model").slideUp();
            }
            if (ajaxLoadFlag == 1) {
              getAjaxDataOnEditColumns();
            }
            if (data.redirect_url) {
              window.location.href = data.redirect_url;
            }
          }
        });
      } else {
        printErrorMsg(data.error);
      }
    },

    error: function (xhr, status, error) {
      Swal.close(); // Close loader
      console.log(xhr.responseJSON.errors);
      if (xhr.responseJSON && xhr.responseJSON.errors) {
        var validationErrors = xhr.responseJSON.errors;

        // Array of names for fields where the error should be shown only on the last field
        var showErrorOnLastField = ["permission"];

        $.each(validationErrors, function (key, errors) {
          // Find fields matching the key
          var fields = $("[name]").filter(function () {
            return $(this).attr("name").includes(key);
          });

          // If the field name is in the array, show error only on the last field
          if (showErrorOnLastField.includes(key) && fields.length > 1) {
            var lastField = fields.last(); // Select the last field
            lastField.addClass("is-invalid");

            if (lastField.hasClass("select2")) {
              lastField
                .parent()
                .find(".select2-container")
                .after(
                  '<div class="error-message text-danger">' +
                    errors[0] +
                    "</div>"
                );
            } else {
              lastField
                .parents(".form-group")
                .append(
                  '<div class="error-message text-danger">' +
                    errors[0] +
                    "</div>"
                );
            }
          } else {
            // Default behavior for fields not in the array
            fields.addClass("is-invalid");

            fields.each(function () {
              var field = $(this);

              if (field.hasClass("select2")) {
                field
                  .parent()
                  .find(".select2-container")
                  .after(
                    '<div class="error-message text-danger">' +
                      errors[0] +
                      "</div>"
                  );
              } else {
                field
                  .parents(".form-group")
                  .append(
                    '<div class="error-message text-danger">' +
                      errors[0] +
                      "</div>"
                  );
              }
            });
          }
        });

        Swal.fire({
          title: "Validation Errors",
          text: "Some fields are mandatory. Please check and correct the errors.",
          icon: "error",
          confirmButtonColor: "#D95000",
        });
      } else if (xhr.responseJSON && xhr.responseJSON.message) {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: xhr.responseJSON.message,
          confirmButtonColor: "#D95000",
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: xhr.responseText,
          confirmButtonColor: "#D95000",
        });
      }
    },
  });
});

function printErrorMsg(msg) {
  $(".print-error-msg").find("ul").html("");
  $(".print-error-msg").css("display", "block");
  $.each(msg, function (key, value) {
    $(".print-error-msg")
      .find("ul")
      .append("<li>" + value + "</li>");
    window.scrollTo(0, 0);
  });
}

function openModal(button, url, title, viewonly = false) {
  var $button = $(button); // Get the button element
  var originalText = $button.html(); // Store the original button text
  $button
    .prop("disabled", true)
    .html(
      `<span class="spinnerforajax"><span class="spinner-grow spinner-border-sm" role="status" aria-hidden="true"></span></span> ${originalText}`
    );

  $("#modal-sidebar .modal-title").html(title);
  // $('#settings').modal('show');
  var thisModel = $("#settinsgs");
  $("body").on("click", '[data-close="model"]', function () {
    $(thisModel).hide();
  });
  $("#modal-sidebar .modal-body").html("");
  $(".loader-container").show();

  // Use jQuery AJAX to fetch modal content
  $.ajax({
    url: url,
    method: "GET",
    success: function (data) {
      $("#modal-sidebar").addClass("open");
      // Inject modal content into the page
      $("#modal-sidebar .modal-tab-content").html(data);
      //  initTinyMCE();
      if (viewonly) {
        $("#modal-sidebar :input").prop("readonly", true);
        $("#modal-sidebar select").prop("disabled", true);
        $("#modal-sidebar textarea").prop("readonly", true);
        $("#modal-sidebar :checkbox").prop("disabled", true);
        $('#modal-sidebar [type="submit"]').remove();
        // tinymce.editors.forEach(function (editor) {
        //   editor.setMode("readonly");
        // });
      }
      $(".loader-container").hide();
      $button.prop("disabled", false).html(originalText); // Reset button
    },
    error: function (xhr, status, error) {
      handleAjaxError(xhr, status, error);
      $(".loader-container").hide();
      $button.prop("disabled", false).html(originalText); // Reset button
    },
  });
}

//Handles Errors
function handleAjaxError(xhr, status, error) {
  console.error("Error loading content:", status);
  console.error("Error loading content:", xhr.status);

  // Extract error message and details
  var errorMessage =
    xhr.responseJSON && xhr.responseJSON.message
      ? xhr.responseJSON.message
      : "An unexpected error occurred.";
  var errorDetails =
    xhr.responseJSON && xhr.responseJSON.details
      ? xhr.responseJSON.details
      : error;

  // Handle specific HTTP status codes
  if (xhr.status === 401) {
    Swal.fire({
      icon: "warning",
      title: "Session Expired",
      text: "Your session has expired. Please log in again.",
    }).then(() => {
      window.location.href = loginUrl;
    });
    return;
  } else if (xhr.status === 403) {
    Swal.fire({
      icon: "error",
      title: "Access Denied",
      text: "You do not have permission to perform this action.",
    });
  } else if (xhr.status === 404) {
    Swal.fire({
      icon: "error",
      title: "Not Found",
      text: "The requested resource could not be found.",
    });
  } else if (xhr.status === 500) {
    Swal.fire({
      icon: "error",
      title: "Server Error",
      text: "An internal server error occurred. Please try again later.",
    });
  } else if (status === "timeout") {
    Swal.fire({
      icon: "warning",
      title: "Timeout",
      text: "The request timed out. Please check your internet connection and try again.",
    });
  } else if (status === "error" && xhr.status === 0) {
    Swal.fire({
      icon: "error",
      title: "Internet Disconnected",
      text: "It seems you are not connected to the internet. Please check your connection.",
    });
  } else {
    Swal.fire({
      icon: "error",
      title: "Error",
      html: `<p>Error Code ${xhr.status}: ${errorMessage}</p><small>${errorDetails}</small>`,
    });
  }
}

function renderLoadingTable(tableId, rows) {
  // Select the table by ID
  const table = $(tableId);
  if (table.length === 0) {
    console.error("Table not found!");
    return;
  }

  // Find thead and count columns
  const thead = table.find("thead");
  if (thead.length === 0) {
    console.error("Thead not found! Please define <thead> with columns.");
    return;
  }

  const columns = thead.find("th").length; // Count the <th> elements
  if (columns === 0) {
    console.error("No columns found in <thead>!");
    return;
  }

  // Clear tbody if it exists
  let tbody = table.find("tbody");
  if (tbody.length === 0) {
    tbody = $("<tbody class='shimmer-table'></tbody>");
    table.append(tbody);
  } else {
    tbody.empty();
    tbody.addClass("shimmer-table");
  }

  // Generate rows and cells with loading-shimmer
  for (let i = 0; i < rows; i++) {
    const tr = $("<tr></tr>");
    for (let j = 0; j < columns; j++) {
      // const td = $(`<td colspan="${columns}">-<span class="loading-shimmer">Loading</span></td>`); // Add shimmer class
      const td = $(`<td >-<span class="loading-shimmer">Loading</span></td>`);
      tr.append(td);
    }
    tbody.append(tr);
  }
}

$(document).ready(function () {
  const body = $("body");
  const switchElement = $("#color-switch-1");

  // Check initial state from Laravel rendered class
  if (switchElement.is(":checked")) {
    body.addClass("layout-dark");
  }

  // On switch toggle
  switchElement.on("change", function () {
    if ($(this).is(":checked")) {
      body.addClass("layout-dark");
      saveTheme("dark");
    } else {
      body.removeClass("layout-dark");
      saveTheme("light");
    }
  });

  // Function to save the theme in cookies
  function saveTheme(theme) {
    $.ajax({
      url: "/set-layout-cookie",
      method: "POST",
      data: { layout: theme },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      success: function () {
        console.log("Cookie saved successfully");
      },
      error: function () {
        console.error("Failed to save cookie");
      },
    });
  }
});

$(document).ready(function () {
  $("body").change("#imageUpload", function (event) {
    var file = event.target.files[0]; // Get the selected file
    if (file) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#imagePreview").css(
          "background-image",
          "url(" + e.target.result + ")"
        ); // Set the blob URL
      };
      reader.readAsDataURL(file); // Read the file as a Data URL
    }
  });
});


function DegitOnly(e) {
  var unicode = e.charCode ? e.charCode : e.keyCode;
  if (unicode != 8 && unicode != 9)//Excepting the backspace and tab keys
  {
      if (unicode < 46 || unicode > 57 || unicode == 47) //If not a number or decimal point
          return false //Disable key press
  }
}


(function (window, undefined) {
  "use strict";

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */
})(window);
