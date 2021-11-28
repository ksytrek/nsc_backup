<!DOCTYPE html>
<html lang="en">
<?php
include_once("./sidebar_ad.php");

$id_mem = $_GET['id'];
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Face Admin Dashboard</title>

	<script src="../../script/assets/js/lib/opencv/opencv.js"></script>
	<script src="../../script/assets/js/lib/opencv/utils.js"></script>
	<!-- <script src="../../script/assets/js/lib/opencv/jquery-1.11.0.min.js"></script> -->


	<!-- <link href="../../script/assets/js/lib/opencv/bootstrap.min.css" rel="stylesheet" media="all"> -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">



</head>

<script>
	window.onload = function() {
		openCvReady();
	}
</script>

<body>
	<div class="content-wrap">
		<div class="main">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-8 p-r-0 title-margin-right">
						<div class="page-header">
							<div class="page-title">
							</div>
						</div>
					</div>
					<div class="col-lg-4 p-l-0 title-margin-left">
						<div class="page-header">
							<div class="page-title">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Management</a></li>
									<li class="breadcrumb-item active">Save Face</li>
								</ol>
							</div>
						</div>
					</div>

				</div>

				<section id="main-content">
					<div class="row">

						<div class="col-lg-6">
							<div class="card">
								<div class="card-title">
									<h4>กำลังบันทึก</h4>
									<video autoplay id="cam_input" height="440" width="440"></video>
								</div>
							</div>

						</div>
						<div class="col-lg-6">
							<div class="card">
								<div class="card-title">
									<h4>ภาพที่ได้</h4>
									<canvas id="canvas_output" class="card-img-top" height="480" width="480"></canvas>

								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-title">
										<h4>ค่าสถานะ</h4>
									</div>
									<!-- <div class="progress m-t-20"> -->
									<span id="progressBar" class="progress-bar bg-success" style="width: 100%; height:15px;" role="progressbar"><span id="status"></span></span>
									<!-- </div> -->
								</div>
							</div>

						</div>

					</div>
			</div>
		</div>
	</div>

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

			// const video = document.getElementById("cam_input"); // video is the id of video tag
			// navigator.mediaDevices.getUserMedia({ video: true, audio: false })
			// .then(function(stream) {
			// 	video.srcObject = stream;
			// 	// video.play();
			// })
			// .catch(function(err) {
			// 	console.log("An error occurred! " + err);
			// });

			let src = new cv.Mat(video.height, video.width, cv.CV_8UC4);
			let dst = new cv.Mat(video.height,  video.width, cv.CV_8UC4);
			let gray = new cv.Mat();
			
			let face_cropped = new cv.Mat(video.height,  video.width, cv.CV_8UC4);
			let face_resize = new cv.Mat(video.height,  video.width, cv.CV_8UC4);
			
			let cap = new cv.VideoCapture(cam_input);
			let faces = new cv.RectVector();
			let classifier = new cv.CascadeClassifier();
			let utils = new Utils('errorMessage');
			let faceCascadeFile = 'haarcascade_frontalface_default.xml'; // path to xml


			utils.createFileFromUrl(faceCascadeFile, faceCascadeFile, () => {
				classifier.load(faceCascadeFile); // in the callback, load the cascade from file 
			});

			const FPS = 30;
			
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
				// if(count < MAX_COUNT){
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
												document.getElementById('progressBar').style.width = percentComplete+" %";
												document.getElementById('status').innerHTML = percentComplete+" %   "+count+" / "+MAX_COUNT;
											}
										}, false)
										return xhr;
									},
										type: "POST",
										url: "./controller/uploadface.php",
										data: { 
											key: "uploadface",
											id_mem: "<?php echo $id_mem ?>",
											imgBase64: dataURL,
											count: count
										},
										beforeSend: function(){
											document.getElementById('progressBar').style.width = 0+" % ";
											document.getElementById('status').innerHTML = 0+" %   "+count+"/"+MAX_COUNT;
										}
								}).done(function(response) {
									console.log('saved: ' + response); 
									if(response == 20){
										alert('บันทึกภาพใบหน้าสำเร็จ');
										// location.assign('./mg_personal_ad.php');
										history.back(1);
										// alert(response);
									}
								});

								count = count + 1;
							}catch(err){
								console.log(err);
							}
						}
					}
				// }else{
				// 	// location.href = './mg_personal_ad.php';
				// 	location.assign('mg_personal_ad.php');

				// 	// location.reload();
				// }

				// schedule next one.
				let delay = 1000/FPS - (Date.now() - begin);
				setTimeout(processVideo, delay);
			}
			
		// schedule first one.
		setTimeout(processVideo, 0);
		};
	}
</script>
	<script src="../../script/assets/js/lib/opencv/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>