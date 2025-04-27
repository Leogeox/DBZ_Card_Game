//met rouge lors ce que champ non rempli ou non respecter // vert si rencontrer
let form = document.getElementById('form')
let email = document.getElementById('email')
let pseudo = document.getElementById('pseudo')
let password1 = document.getElementById('password')
let password2 = document.getElementById('password2')
let passwords = [password1, password2]
let passCheck = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[-+_!@#$%^&*., ?]).+$")

form.addEventListener('submit', function(event) {
    event.preventDefault();
    console.log('Form sent');

    if(pseudo.value.length < 3 ) {
        pseudo.classList.add('invalid')
    } else {
        pseudo.classList.remove('invalid')
        pseudo.classList.add('success')
    };


    if(email.value == '') {
        email.classList.add('invalid')
    } else {
        email.classList.remove('invalid')
        email.classList.add('success')
    };

    if(password1!==password2) {
        password1.classList.add('invalid')
        password2.classList.add('invalid')
    } else {
        password1.classList.remove('invalid')
        password1.classList.add('success')
        password2.classList.remove('invalid')
        password2.classList.add('success')
    }

    if(passwords[0,1].value.length < 8 || passCheck.test(passwords[0,1].value) === false) {
        password1.classList.add('invalid')
        password2.classList.add('invalid')
    } else {
        password1.classList.remove('invalid')
        password1.classList.add('success')
        password2.classList.remove('invalid')
        password2.classList.add('success')
     };
});


let tabs = document.querySelectorAll('.pages');
let divs = document.querySelectorAll('.content');

tabs.forEach((tab) => {
    tab.addEventListener('mouseover', function(){
        tabs.forEach((tab) => {
            tab.classList.remove('tab_active')}) 
        this.classList.add('tab_active')
        divs.forEach((div) => {
            div.classList.remove('active')
            div.classList.add('content')
        })  
        if(this.classList.contains('tab_1')) {
            divs[0].classList.add('active')
            divs[0].classList.remove('content')
            
        }else if (this.classList.contains('tab_2')) {
            divs[1].classList.add('active');
            divs[1].classList.remove('content')
        }
    })    
})
