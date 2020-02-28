let inputEmail = document.getElementById("inputEmail");
let inputPasswd = document.getElementById("inputPassword");
let button = document.getElementById("submit")
let passDiv = document.getElementById("passDiv");
let emailDiv = document.getElementById("emailDiv");



button.addEventListener("click", ()=> {
    let passwdErr = document.getElementById("errorpswd");
    let emailErr = document.getElementById("errorpswd");
    if (inputEmail.value == "" && emailErr == null)
    {
        console.log("ERROR")
        var tag = document.createElement("p");
        var text = document.createTextNode("Veuillez entrez un pseudo ou une addresse e-mail");
        tag.appendChild(text);
        tag.id = "errormail"
        tag.classList.add("alert-danger");
        emailDiv.appendChild(tag)
    }
    if (inputPasswd.value == "" && passwdErr == null)
    {
        passDiv.removeChild(passDiv.childNodes[2]);
        console.log("ERROR")
        var tag = document.createElement("p");
        var text = document.createTextNode("Veuillez entrez un mot de passe");
        tag.appendChild(text);
        tag.id = "errorpswd"
        tag.classList.add("alert-danger");
        passDiv.appendChild(tag)
    }
    if (inputPasswd.value != "" && inputEmail.value != ""){
        redirectPost()
    }
})

let redirectPost = ()=>{
    let url = "Request/signinRequest.php"
    let form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'POST';
    form.action = url;
    let email = document.createElement('input');
        email.type = 'hidden';
        email.name = "email";
        email.value = inputEmail.value;
        form.appendChild(email);

    let passwd = document.createElement('input');
    passwd.type = 'hidden';
    passwd.name = "passwd";
    passwd.value = inputPasswd.value;
    form.appendChild(passwd);
    console.log(form)
}
