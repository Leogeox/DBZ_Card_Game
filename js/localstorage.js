let storageInput = document.querySelector('.enter');
let storageEmail = document.getElementById('email');
let storageName = document.getElementById('name');

// localStorage.setItem("lastname", "Smith");
// Retrieve
// document.getElementById("demo").innerHTML = localStorage.getItem("lastname");


window.addEventListener('DOMContentLoaded', () => {
    // enregistre la value de l'input de l'email
    let storedEmail = localStorage.getItem('storageEmail');
    let storedName = localStorage.getItem('storageName');
    if (storedEmail) {
        // la value de l'email equivaut a celui qui a etait enregistrer
        storageEmail.value = storedEmail;
    }

    if (storedName) {
        storageName.value = storedName;
    }
});

let saveToLocalStorage = () => {
    // le localstorage prend la value dans l'email
    localStorage.setItem('storageEmail', storageEmail.value);
    localStorage.setItem('storageName', storageName.value);
};

storageEmail.addEventListener('input', saveToLocalStorage);
// prend la value de l'email et l'enregistre dans le localsotrage
storageName.addEventListener('input', saveToLocalStorage);

