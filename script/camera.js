let camButton = document.getElementById("Scam")
let video = document.querySelector("#videoElement");
let width = 600;


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

let createImageElement = (data) =>{
    let img  = document.createElement("img")
    img.src= data;
    return img
}


let createNewForm = (data)=>{
    let url = "./downloadImg.php"
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
    form.remove()
    document.location.replace('./camera.php?s=1');

//    window.open(`../downloadImg.php?img=${data}`, "test", "height=500,width=500");
}


let stopCamera=()=>{
    video.srcObject = null
}
