<div class="create">
    <div class="create_left">
        <div class="create_left_top">
            <div class="camera">
                <table>
                    <tr><td><video id="video"></video></td></tr>
                    <tr><td align="center"><button class="btn btn-primary my-2 my-sm-0" id="startbutton">Capturer</button></td></tr>
                </table>
                <canvas id="canvas"></canvas>
            </div>
            <div class="output">
                <table>
                    <tr><td class="capture"><img id="photo" alt="The screen capture will appear in this box."></td></tr>
                    <tr><td align="center">
                        <form action="./index.php" method="POST">
                            <input type="hidden" name="image" id="image-tag">
                            <input type="hidden" name="action" value="createchecker">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">Sauvegarder</button>
                        </form>
                    </td></tr>
                </table>
            </div>
        </div>
        <div class="create_left_bottom">
            <div class="frames">
                <!-- Put the frames here -->
                <?= $frames ?>
            </div>
            <div class="objects">
                <!-- Put the objects here -->
                <?= $objects ?>
            </div>
        </div>
    </div>
    <div class="create_right">
        <div class="user_gallery">
            <!-- I PUT THE USER GALLERY HERE -->
            <?= $user_gallery ?>
        </div>
    </div>
</div>

<script>
(function() {
    var width = 320;    // We will scale the photo width to this
    var height = 240;     // This will be computed based on the input stream
    var streaming = false;
    var video = null;
    var canvas = null;
    var photo = null;
    var startbutton = null;
    var capturebutton = null;

    function startup() {
        video = document.getElementById('video');
        canvas = document.getElementById('canvas');
        photo = document.getElementById('photo');
        startbutton = document.getElementById('startbutton');

        navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(function(stream) {
            video.srcObject = stream;
            video.play();
        })
        .catch(function(err) {
            console.log("An error occurred! " + err);
        });

        video.addEventListener('canplay', function(ev){
            if (!streaming) {
            //height = video.videoHeight / (video.videoWidth/width);
            
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
            }
        }, false);

        startbutton.addEventListener('click', function(ev){
            takepicture();
            ev.preventDefault();
            let myImg = document.getElementById('photo').src;
            document.getElementById('image-tag').value = myImg;
        }, false);

        clearphoto();
    }

    function clearphoto() {
        var context = canvas.getContext('2d');
        context.fillStyle = "#AAA";
        context.fillRect(0, 0, canvas.width, canvas.height);

        var data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
    }

    function takepicture() {
        var context = canvas.getContext('2d');
        if (width && height) {
            canvas.width = width;
            canvas.height = height;
            context.drawImage(video, 0, 0, width, height);
            var data = canvas.toDataURL('image/png');
            photo.setAttribute('src', data);
        } else {
            clearphoto();
        }
    }
    window.addEventListener('load', startup, false);
})();
</script>