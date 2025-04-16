

/* ------ 
function search() {
    var a = document.getElementById('searchbar').value
    var divs = document.querySelectorAll('.content')
    var textbox = document.querySelectorAll('.textbox')

    if(a === "form"){
        divs[0].classList.add('active');
        divs[0].classList.remove('content')
        textbox[0].classList.add('textbox_active')
        textbox[0].classList.remove('textbox')
        console.log("AHH")

    } else if(a === "booster"){
        document.querySelector('.tab_2').classList.add('tab_active')
        divs[1].classList.add('active')
        divs[1].classList.remove('content')
        textbox[1].classList.add('textbox_active')
        textbox[1].classList.remove('textbox')

    } else if(a === "cards"){
        document.querySelector('.tab_3').classList.add('tab_active')
        divs[2].classList.add('active')
        divs[2].classList.remove('content')
        textbox[2].classList.add('textbox_active')
        textbox[2].classList.remove('textbox')

    } else if(a === "game"){
        document.querySelector('.tab_4').classList.add('tab_active')
        divs[3].classList.add('active')
        divs[3].classList.remove('content')
        textbox[3].classList.add('textbox_active')
        textbox[3].classList.remove('textbox')
    }

}---- */

let favs = document.querySelectorAll('.fav')
let favfulls = document.querySelectorAll('.favfull')

favs.forEach((fav, index) => {
    fav.addEventListener('click', function() {
        fav.classList.add('favnone')
        favfulls[index].classList.remove('favnone')
        favfulls[index].addEventListener('click', function() {
            fav.classList.remove('favnone')
            favfulls[index].classList.add('favnone')
        })
    })
})










