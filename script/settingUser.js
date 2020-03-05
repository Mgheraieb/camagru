let mailButton = document.getElementById("mailChange")
let passButton = document.getElementById("passChange")

let ValidateEmail = (mail)=>{
   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
        return (true)
    return (false)
}


let createForm = (type,  url) =>{
    let div = document.getElementById(`${type}Div`)
    let form = document.createElement('form');
    form.appendChild(div);
    form.method = 'POST';
    form.target = "_blank";
    form.action = url;
    form.submit();
    document.getElementById(`${type}Main`).appendChild(form)
}

let deleteError = (input) =>{
    input.className=`form-control is-valid`
    let a = document.getElementById(`${input.id}error`)
    if (a != null)
        a.remove();


}


let addError = (input, text) =>{

    deleteError(input);
    input.className=`form-control is-invalid`
    if (document.getElementById(`${input.id}error`) == null) {
        let error = document.createElement("div");
        error.className = "invalid-feedback"
        error.id = `${input.id}error`
        error.innerText = text
        input.after(error)
        error.hidden = false;
    }

}
let refreshPage = () =>{
    let newLink = document.createElement("a");
    newLink.href = "./monCompte.php?mail=1";
    document.body.appendChild(newLink)
    newLink.click();
}

mailButton.addEventListener("click", ()=>{
    let mail = document.getElementById("mail")
    if (ValidateEmail(mail.value) == false)
    {
        addError(mail, "Format invalide");
    }
    else{
        mail.className=`form-control is-valid`
        createMailForm("mail", "Request/changeMail.php");
        setTimeout(function () {
            window.location.href = "./monCompte.php"; //will redirect to your blog page (an ex: blog.html)
        }, 500); //will call the function after 2 secs.
    }
    console.log(mail)
})



passButton.addEventListener("click", ()=>{
    pass = document.getElementById("pass");
    confirmation = document.getElementById("confirmation");


    deleteError(pass)
    deleteError(confirmation)
    if (pass.value != confirmation.value){
        addError(confirmation, "Mot de passe different")
    }
    else if (pass.value == "" || confirmation.value == ""){
        addError(pass, "Format invalide")
        addError(confirmation, "Format Invalide");
    }
    else{
        createForm("pass","Request/ChangePassword.php");
    }
})
