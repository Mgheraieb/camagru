let inputname = document.getElementById("username");
let inputEmail = document.getElementById("email");
let inputVerifEmail = document.getElementById("emailVerif");
let inputPasswd = document.getElementById("password");
let inputverifPasswd = document.getElementById("passwordVerif");
let button = document.getElementById("submit")



let clicked = 0;

button.addEventListener("click" , ()=> {
    buttonClick();
})
let buttonClick=()=>{
    if (clicked == 1)
        return ;
    clicked = 1;

    let nameValue = inputname.value;
    let passValue = inputPasswd.value
    let passVerifValue = inputverifPasswd.value
    let mailValue = inputEmail.value
    let mailVerifValue = inputVerifEmail.value
    let errorpass = 0;
    let errormail = 0;
    let errorGlobal = 0;

    deleteDomElement("usernameDiverror")
    deleteDomElement("pswdDiverror")
    deleteDomElement("pswdVerifDiverror")
    deleteDomElement("mailDiverror")
    deleteDomElement("mailVerifDiverror")
    if (passValue != passVerifValue){
        errorGlobal = 1;
        errorpass = 1;
        deleteDomElement("pswdDiverror")
        deleteDomElement("pswdVerifDiverror")
        addError("Veuillez entrez le meme mot de passe", "paswdMainDiv");
    }else{
        deleteDomElement("paswdMainDiverror")
    }

    if (mailValue != mailVerifValue){
        errorGlobal = 1;
        errormail = 1;
        deleteDomElement("mailDiverror")
        deleteDomElement("mailVerifDiverror")
        addError("Veuillez entrez la meme adresse ", "mailMainDiv");
    }else{
        deleteDomElement("mailMainDiverror")
    }

    if (nameValue == "") {
        errorGlobal = 1;
        addError("Veuillez entrer un nom d'utilisateur", "usernameDiv")
    }
    if (errorpass == 0){
        if (passValue == "") {
            errorGlobal = 1;
            addError("Veuillez entrer un mot de passe", "pswdDiv")
        }
        if (passVerifValue == "") {
            errorGlobal = 1;
            addError("Veuillez confirmez votre mot de passe", "pswdVerifDiv")
        }
    }
    if (errormail == 0) {
        if (mailValue == "") {
            errorGlobal = 1;
            addError("Veuillez entrer une adresse Email", "mailDiv")
        }
        if (mailVerifValue == "") {
            errorGlobal = 1;
            addError("Veuillez confirmez votre adresse Email", "mailVerifDiv")
        }
    }
    clicked = 0;
    if (errorGlobal == 0){
        registerUser();
    }
}

let registerUser =()=>{
    button.type = "submit"
    button.click()
}


let addError = (text, elmt)=>{
    let div = document.getElementById(elmt)
    var tag = document.createElement("p");
    var text = document.createTextNode(text);
    tag.appendChild(text);
    tag.id = elmt+"error"
    tag.classList.add("alert-danger");
    div.appendChild(tag)
}

let deleteDomElement = (id) =>{
    let element = document.getElementById(id);
    if (element != null)
        element.parentNode.removeChild(element);
}

let RegistrationError = ()=>{
    var url = new URL(window.location);

    var params = new URLSearchParams(url.search);
    let nameError = params.get("name")
    let mailError = params.get("mail")
    if (nameError == null || mailError == null)
       return false;
    if (nameError != null){
        addError("Ce nom d'utilisateur est deja pris","usernameDiv");
        inputname.value=nameError
    }
    if(mailError != null){
        inputEmail.value = mailError;
        inputVerifEmail.value = mailError;
        addError("Cette email est deja prise","mailMainDiv");
    }
}


RegistrationError();
