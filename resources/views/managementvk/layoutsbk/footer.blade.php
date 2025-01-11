<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="widget">

                </div>
            </div>
            <div class="col-md-4">
                <div class="widget">

                </div>
            </div>
            <div class="col-md-4">
                <div class="widget">

                </div>
            </div>
        </div>

    </div>
</footer>
<div class="copyright text-center">
    <div class="container">
        <p>All Rights Reserved</p>
    </div>
</div>

<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/get_ajax_data.js')}}"></script>
<script src="{{asset('assets/js/form_submit.js')}}"></script>
<!-- Include necessary JavaScript files -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
{{--<link href="https://fonts.googleapis.com/icon?family=Material+Icons"--}}
{{--      rel="stylesheet">--}}
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script>
    new WOW().init();
</script>

<script>
    // Wait for the DOMContentLoaded event
    document.addEventListener("DOMContentLoaded", function() {
        // Add event listener for file input
        document.getElementById('files').addEventListener('change', handleFileSelect, false);

        // Initialize sortable after the thumbnails are added
        initSortable();
    });

    function handleFileSelect(evt) {
        var files = evt.target.files;
        var output = document.getElementById("sortableImgThumbnailPreview");

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {
            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var imgThumbnailElem = "<div class='RearangeBox imgThumbContainer'><i class='material-icons imgRemoveBtn' onclick='removeThumbnailIMG(this)'>cancel</i><div class='IMGthumbnail' ><img  src='" + e.target.result + "'" + "title='"+ theFile.name + "'/></div><div class='imgName'>"+ theFile.name +"</div></div>";

                    output.innerHTML = output.innerHTML + imgThumbnailElem;

                    // Reinitialize sortable after adding thumbnails
                    initSortable();
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }

    function removeThumbnailIMG(elm){
        elm.parentNode.outerHTML='';
    }

    function initSortable() {
        $("#sortableImgThumbnailPreview").sortable({
            connectWith: ".RearangeBox",
            start: function( event, ui ) {
                $(ui.item).addClass("dragElemThumbnail");
                ui.placeholder.height(ui.item.height());
            },
            stop:function( event, ui ) {
                $(ui.item).removeClass("dragElemThumbnail");
            }
        });
        $("#sortableImgThumbnailPreview").disableSelection();
    }

    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

</body>
</html>
