<form action="{{ route('athletes.store') }}" method="POST" enctype="multipart/form-data" id="subm">
    @csrf
    <input type="hidden" id="listRefresh" value="{{ route('get.athletes') }}" />

    <div class="form-group">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' id="imageUpload" name="profile_image" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload">
                            <span class="material-symbols-outlined">edit</span>
                        </label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url('');">
                        </div>
                    </div>
                </div>
                <h1 class="text-center font-weight-bold my-4">{{auth()->user()->name}}</h1>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter Athlete Name" class="form-control" required />
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Enter Athlete Email" class="form-control" required />
    </div>

    <div class="form-group">
        <label for="weight">Weight (kg):</label>
        <input type="number" name="weight" id="weight" placeholder="Enter Weight" class="form-control" step="0.1" required />
    </div>

    <div class="form-group">
        <label for="height">Height (cm):</label>
        <input type="number" name="height" id="height" placeholder="Enter Height" class="form-control" step="0.1" required />
    </div>


    <div class="form-group">
        <label for="bio">Bio:</label>
        <textarea name="bio" id="bio" placeholder="Enter Bio" class="form-control" rows="4"></textarea>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Save Athlete</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>

<script>
   // Event delegation to handle dynamically added elements
   document.body.addEventListener("change", function(event) {
    // Check if the change event came from the file input
    if (event.target && event.target.id === "file-input") {
        previewImage(event);
    }
});

function previewImage(event) {
    var fileInput = event.target;
    var imagePreview = document.getElementById("imagePreview");

    // Check if a file is selected
    if (fileInput.files.length > 0) {
        var file = fileInput.files[0];

        // Check if the selected file is an image
        if (file.type.startsWith("image/")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // Display the image preview
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            // If the selected file is not an image, clear the preview
            imagePreview.src = "#";
        }
    } else {
        // Clear the image preview if no file is selected
        imagePreview.src = "#";
    }
}



    
</script>

<style>

.avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 5px auto;
}
.avatar-upload .avatar-edit {
    position: absolute;
    right: 10%;
    z-index: 1;
    bottom: 10px;
}
.avatar-upload .avatar-edit input {
    display: none;
}
.avatar-upload .avatar-edit input + label {
    display: inline-flex;
    width: 40px;
    height: 40px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
    align-items: center !important;
    justify-content: center;
    background: #D95000;
    color: #fff;
    border: 3px solid white;
    padding: 0;
}
.avatar-upload .avatar-edit input + label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
}
.avatar-upload .avatar-preview {
    width: 192px;
    height: 192px;
    position: relative;
    border-radius: 100%;
    border: 6px solid #F8F8F8;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.avatar-upload .avatar-preview > div {
    width: 100%;
    height: 100%;
    border-radius: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}

</style>
