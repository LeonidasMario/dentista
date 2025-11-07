const userBtn = document.querySelector('#user-btn');
userBtn.addEventListener('click' , function(){
    const userBox = document.querySelector('.profile');
    userBox.classList.toggle('active');
});
const toggle = document.querySelector('#menu-btn');
toggle.addEventListener('click' , function(){
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
});
let  searchForm = document.querySelector('.search-form');
    document.querySelector('#search-btn').onclick = () =>{
           searchForm.classList.toggle('active');
    }
 
    const imgBox = document.querySelector('.slider-container');
    const slides = document.getElementsByClassName('slideBox');
    var i = 0;

    function nextSlide(){
        slides[i].classList.remove('active');
        i = (i + 1 ) % slides.length;
        slides[i].classList.add('active');
    }
     
    function prevSlide(){
        slides[i].classList.remove('active');
        i = (i - 1 + slides.length) % slides.length;
        slides[i].classList.add('active');
    }