//met rouge lors ce que champ non rempli ou non respecter // vert si rencontrer
let form = document.getElementById('form')
let email = document.getElementById('email')
let password1 = document.getElementById('password')
let password2 = document.getElementById('password2')
let passwords = [password1, password2]
let passCheck = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[-+_!@#$%^&*., ?]).+$")

form.addEventListener('submit', function(event) {
    console.log('Form sent');

    if(email.value == '') {
        email.classList.add('invalid')
    } else {
        email.classList.remove('invalid')
        email.classList.add('success')
    };

    if(password1.value !== password2.value) {
        password1.classList.add('invalid')
        password2.classList.add('invalid')
    } else {
        password1.classList.remove('invalid')
        password1.classList.add('success')
        password2.classList.remove('invalid')
        password2.classList.add('success')
    }

    if(passwords[0,1].value.length < 2 || passCheck.test(passwords[0,1].value) === false) {
        password1.classList.add('invalid')
        password2.classList.add('invalid')
    } else {
        password1.classList.remove('invalid')
        password1.classList.add('success')
        password2.classList.remove('invalid')
        password2.classList.add('success')
     };
});