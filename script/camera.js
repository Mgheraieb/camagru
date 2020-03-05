let camButton = document.getElementById("Scam")
let video = document.querySelector("#videoElement");
let test = $("#test")
let test1 = $("#test1")
let test2 = $("#test2")
let mouve = false
let width = 600;

let testOffset = {
    firstX : document.getElementById("test").offsetLeft,
    firstY : document.getElementById("test").offsetTop,
}
let test1Offset = {
    firstX : document.getElementById("test1").offsetLeft,
    firstY : document.getElementById("test1").offsetTop,
}
let test2Offset = {
    firstX : document.getElementById("test2").offsetLeft,
    firstY : document.getElementById("test2").offsetTop,
}

test.bind("mousedown" , () => { mouve = $("#test");})
test1.bind("mousedown", () => { mouve = $("#test1");})
test2.bind("mousedown", () => { mouve = $("#test2");})


$(document).bind('mousemove', function(e){
    if (mouve != false) {
        mouve.css({
            left: e.pageX + 20,
            top: e.pageY
        });
    }
});

$(document).bind("mouseup", ()=>{mouve = false;})

camButton.addEventListener("click", ()=>{
    let value = parseInt(camButton.value);
    if (value == 0){
        camButton.className="btn btn-danger btn-group mr-2"
        camButton.value = "1"
        camButton.innerText = "Desactiver la camera"
        addElement();
    }else{
        let snap = document.getElementById("snap")
        snap.remove();
        camButton.className="btn btn-success btn-group mr-2"
        camButton.value = "0"
        camButton.innerText = "Activer la camera"
        stopCamera();
    }
})

let startCamera = () =>{
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                video.srcObject = stream;
            })
            .catch(function (err0r) {
                console.log("Something went wrong!");
            });
    }

}

window.addEventListener("DOMContentLoaded", (event) => {
    var url = new URL(window.location);
    var params = new URLSearchParams(url.search);
    let success = params.get("s")
    if (success == "1") {
        let text = "Felicitation votre image est desormais disponible";
        let div = document.createElement("p")
        div.className = "alert alert-success"
        div.role = "alert";
        div.innerHTML = text;
        camButton.before(div);
    }
    let camerastart = params.get("c");
    if (camerastart == '1'){
        camButton.click();
    }

});

let addElement = () =>{
    let link = document.createElement('a');
    link.textContent = 'Télécharger une image';
    link.className = "btn btn-primary btn-group mr-2";
    link.id = "snap";
    camButton.after(link);

    let canvas = document.createElement("canvas");
    canvas.id = "cnv";
    canvas.hidden = true;


    link.addEventListener('click', function(ev){
        takepicture(canvas);
        ev.preventDefault();
    }, false);



    video.addEventListener('canplay', function(ev){
        height = video.videoHeight / (video.videoWidth/width);
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        streaming = true;
    }, false);
    startCamera();


}


let getPositions = ()=>{


    let t1 = document.getElementById("test");
    let t2 = document.getElementById("test1")
    let t3 = document.getElementById("test2")
    let vid = document.getElementById("videoElement")

    var Offset1 = {
        top: t1.offsetTop - document.getElementById("videoElement").offsetTop,
        left: t1.offsetLeft - document.getElementById("videoElement").offsetLeft,
    }
    if (Offset1.top > vid.offsetTop || Offset1.left > vid.offsetHeight || Offset1.top < 0 || Offset1.left < 0)
        Offset1 = false

    var Offset2 = {
        top: t2.offsetTop - document.getElementById("videoElement").offsetTop,
        left: t2.offsetLeft - document.getElementById("videoElement").offsetLeft,
    }
    if (Offset2.top > vid.offsetTop || Offset2.left > vid.offsetHeight || Offset2.top < 0 || Offset2.left < 0)
        Offset2 = false

    var Offset3 = {
        top: t3.offsetTop - document.getElementById("videoElement").offsetTop,
        left: t3.offsetLeft - document.getElementById("videoElement").offsetLeft,
    }
    if (Offset3.top > vid.offsetTop || Offset3.left > vid.offsetHeight || Offset3.top < 0 || Offset3.left < 0)
        Offset3 = false

    let x1 = (Offset1 != false) ? Offset1.left : -1
    let y1 = (Offset1 != false) ? Offset1.top : -1

    let x2 = (Offset2 != false) ? Offset2.left : -1
    let y2 = (Offset2 != false) ? Offset2.top : -1

    let x3 = (Offset3 != false) ? Offset3.left : -1
    let y3 = (Offset3 != false) ? Offset3.top : -1


    return {x1 : x1, y1 :y1, x2 : x2, y2 : y2, x3 : x3, y3 : y3}

}

let createNewForm = (data)=>{

    let pos = getPositions();
    console.log(pos)

    let url = `./downloadImg.php?x1=${pos.x1}&y1=${pos.y1}&x2=${pos.x2}&y2=${pos.y2}&x3=${pos.x3}&y3=${pos.y3}`
    let form = document.createElement('form');
    document.body.appendChild(form);
    form.hidden = true
    form.method = 'POST';
    form.target = "_blank"
    form.action = url;
    form.enctype="multipart/form-data"

    let img = document.createElement('input');
    img.type = 'hidden';
    img.value = data
    img.name = "img"
    form.appendChild(img)
    return form
}

let takepicture = (canvas) => {
    console.log(canvas)
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    let data = canvas.toDataURL('image/jpg');
    let form = createNewForm(data)
    form.submit()
  /*  form.remove()
    let reload = document.createElement("a");

    reload.href = "./camera.php?s=1&c=1";
    reload.click();*/

//    window.open(`../downloadImg.php?img=${data}`, "test", "height=500,width=500");
}


let stopCamera=()=>{
    video.srcObject = null
}
