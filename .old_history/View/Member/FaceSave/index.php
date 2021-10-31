<html lang="en">
<?php 
require_once('../../../Config/path.php');
?>
<head>

	<style>

		.box{
			border: 2px black solid;
			padding: 10px;
			width: fit-content;
		}

		.bar{
			border: 1px gray solid;
			background-color: antiquewhite;
			width: 100%;
			height: 20px;
		}   

		.fill 
		{   
			background-color: rgb(21, 255, 0);
			width: 0%;
			height: 20px;
			display: block;
			transition: 1s;
		}
	</style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opencv JS</title>
    <script async src="js/opencv.js"  onload="openCvReady()"></script>

    <script src="js/utils.js"></script>
    <script src="js/jquery-1.11.0.min.js"></script>


    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->

    <link href="../../../Script/css/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


</head>
<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
          <div class="container-fluid">
              <a class="navbar-brand" href="./index.php">Mamber</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
              
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    เมนูหลัก
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                      <li><a class="dropdown-item" href="./face_save.php">FaceDetection SAVE</a></li>
                      <li><a class="dropdown-item" href="./FaceSave/">ทดสอบ</a></li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop">บันทึกใบหน้า</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
		</nav> -->
		
<center>
    <div class="container-xxl">
        <video autoplay id="cam_input" height="480" width="640"></video>
    </div>
    <div class="card" style="width: 18rem;">
		<img src="..." class="card-img-top" alt="...">
		<canvas id="canvas_output" class="card-img-top"></canvas>
	</div>
    <div class="container-xl">
        <div class="bar">
            <span class="fill" id="progressBar"><span id="status"></span></span>
        </div>
	</div>
	<button style="display: none;" id="btn" onclick="location.href='<?php echo _MEMBER ?>'">ESC</button>
</center>
</body>

<script type="text/JavaScript">
	function openCvReady() {
		                
		let count = 0;
		let MAX_COUNT = 20;

		cv['onRuntimeInitialized']=()=>{
			const constraints = {
				video: true,
			};
			const video = document.querySelector("video");
			navigator.mediaDevices.getUserMedia(constraints).then((stream) => {
				video.srcObject = stream;
			});

			//let video = document.getElementById("cam_input"); // video is the id of video tag
			// navigator.mediaDevices.getUserMedia({ video: true, audio: false })
			// .then(function(stream) {
			// 	video.srcObject = stream;
			// 	// video.play();
			// })
			// .catch(function(err) {
			// 	console.log("An error occurred! " + err);
			// });

			let src = new cv.Mat(video.height, video.width, cv.CV_8UC4);
			let dst = new cv.Mat(video.height, video.width, cv.CV_8UC4);
			let gray = new cv.Mat();
			
			let face_cropped = new cv.Mat(video.height, video.width, cv.CV_8UC4);
			let face_resize = new cv.Mat(video.height, video.width, cv.CV_8UC4);
			
			let cap = new cv.VideoCapture(cam_input);
			let faces = new cv.RectVector();
			let classifier = new cv.CascadeClassifier();
			let utils = new Utils('errorMessage');
			let faceCascadeFile = 'haarcascade_frontalface_default.xml'; // path to xml


			utils.createFileFromUrl(faceCascadeFile, faceCascadeFile, () => {
				classifier.load(faceCascadeFile); // in the callback, load the cascade from file 
			});

			const FPS = 24;
			
			let start_time = Date.now();

			function processVideo() {
				var canvas_output = document.getElementById('canvas_output');
					let begin = Date.now();
					cap.read(src);
					src.copyTo(dst);
					cv.cvtColor(dst, gray, cv.COLOR_RGBA2GRAY, 0);
					try{
						classifier.detectMultiScale(gray, faces, 1.1, 3, 0);
						console.log(faces.size());
					}catch(err){
						console.log(err);
					}
					for (let i = 0; i < faces.size(); ++i) {
						let face = faces.get(i);
						let point1 = new cv.Point(face.x, face.y);
						let point2 = new cv.Point(face.x + face.width, face.y + face.height);
						//let rect = new cv.Rect(face.x, face.y, face.x + face.width, face.y  + face.height);
						//console.log(rect);
						face_cropped = src.roi(face);
						cv.resize(face_cropped, face_resize, new cv.Size(256, 256), 0, 0, cv.INTER_AREA); 
						//console.log('image width: ' + face_resize.cols + '\n' +'image height: ' + face_resize.rows + '\n');
						cv.rectangle(dst, point1, point2, [255, 0, 0, 255]);
						
					}
				if(count < MAX_COUNT){
					if(faces.size() > 0){
						if((Date.now() - start_time) >= 1500){
							start_time = Date.now();
							cv.imshow("canvas_output", face_resize);
							try{
								var  dataURL = canvas_output.toDataURL();
								$.ajax({

									xhr: function() {
										var xhr = new window.XMLHttpRequest();
										xhr.upload.addEventListener("progress", function(evt) {
											if (evt.lengthComputable) {
												var percentComplete = Math.round((evt.loaded / evt.total)) * 100;
												document.getElementById('progressBar').style.width = percentComplete+"%";
												document.getElementById('status').innerHTML = percentComplete+"%   "+count+"/"+MAX_COUNT;
											}
										}, false)
										return xhr;
									},
										type: "POST",
										
										// http://localhost/facedetect/Controller/uploadface.php
										url: "<?php echo _CONTROLLER.'uploadface.php' ?>",
										data: { 
											imgBase64: dataURL,
											count: count
										},
										beforeSend: function(){
											document.getElementById('progressBar').style.width = 0+"%";
											document.getElementById('status').innerHTML = 0+"%   "+count+"/"+MAX_COUNT;
										}
								}).done(function(response) {
									console.log('saved: ' + response); 
								});

								count = count + 1;
							}catch(err){
								console.log(err);
							}
						}
					}
				}else{
					document.getElementById("btn").style.display = "";
				}

				// schedule next one.
				let delay = 1000/FPS - (Date.now() - begin);
				setTimeout(processVideo, delay);
			}
			
		// schedule first one.
		setTimeout(processVideo, 0);
		};
	}
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

   <script src="../../Script/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
 
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper)
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

 -->
</html>
