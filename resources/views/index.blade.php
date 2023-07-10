<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .container {
            position: relative;
            display: flex;
            width: max-content;
            height: max-content;
            justify-content: center;
            align-items: center;
        }
        .container #video {
            width: 600px;
            height: 400px;
            border-radius: 20px;
        }
        .container .controls {
            position: absolute;
            bottom: 40px;
            width: 100%;
            display: flex;
            justify-content: space-around;
            opacity: 0.2;
            transition: opacity 0.4s;
        }
        .container:hover .controls {
            opacity: 1;
        }
        .container .controls button {
            background: transparent;
            color: #fff;
            font-weight: bolder;
            text-shadow: 2px 1px 2px #000;
            border: none;
            cursor: pointer;
        }
        .container .controls .timeline {
            flex: 1;
            display: flex;
            align-items: center;
            border: none;
            border-right: 3px solid #ccc;
            border-left: 3px solid #ccc;
        }
        .container .controls .timeline .bar{
            background: rgb(1, 1, 65);
            height: 4px;
            flex: 1;
        }
        .container .controls .timeline .bar .inner{
            background: #ccc;
            width: 0%;
            height: 100%;
        }
        .fa {
            font-size: 20px !important;
        }

        video::-webkit-media-controls-enclosure{
            display: none !important;
        }
    </style>


</head>
<body>
<div class="container">
    <video onclick="play(event)" src="{{asset('/storage/videos/'.$video->path)}}" id="video"></video>
    <div class="controls">
        <button onclick="play(event)"><i class="fa fa-play"></i><i class="fa fa-pause"></i></button>
        <button onclick="rewind(event)"><i class="fa fa-fast-backward"></i></button>
        <div class="timeline">
            <div class="bar">
                <div class="inner"></div>
            </div>
        </div>
        <button onclick="forward(event)"><i class="fa fa-fast-forward"></i></button>
        <button onclick="fullScreen(event)"><i class="fa fa-expand"></i></button>
        <button onclick="download(event)"><i class="fa fa-cloud-download"></i></button>
    </div>
</div>
<script src="script.js"></script>

<script>
    // Select the HTML5 video
    const video = document.querySelector("#video")
    // set the pause button to display:none by default
    document.querySelector(".fa-pause").style.display = "none"
    // update the progress bar
    video.addEventListener("timeupdate", () => {
        let curr = (video.currentTime / video.duration) * 100
        if(video.ended){
            document.querySelector(".fa-play").style.display = "block"
            document.querySelector(".fa-pause").style.display = "none"
        }
        document.querySelector('.inner').style.width = `${curr}%`
    })
    // pause or play the video
    const play = (e) => {
        // Condition when to play a video
        if(video.paused){
            document.querySelector(".fa-play").style.display = "none"
            document.querySelector(".fa-pause").style.display = "block"
            video.play()
        }
        else{
            document.querySelector(".fa-play").style.display = "block"
            document.querySelector(".fa-pause").style.display = "none"
            video.pause()
        }
    }
    // trigger fullscreen
    const fullScreen = (e) => {
        e.preventDefault()
        video.requestFullscreen()
    }
    // download the video
    const download = (e) => {
        e.preventDefault()
        let a = document.createElement('a')
        a.href = video.src
        a.target = "_blank"
        a.download = ""
        document.body.appendChild(a)
        a.click()
        document.body.removeChild(a)
    }
    // rewind the current time
    const rewind = (e) => {
        video.currentTime = video.currentTime - ((video.duration/100) * 5)
    }
    // forward the current time
    const forward = (e) => {
        video.currentTime = video.currentTime + ((video.duration/100) * 5)
    }
</script>
</body>
</html>
