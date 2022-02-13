const menuToggle = document.querySelector(".toggle")
const showcase = document.querySelector(".showcase")
menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('active')
    showcase.classList.toggle('active')
})
var swiper = new Swiper(".review-slider", {
    spaceBetween: 20,
    loop:true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
    },
});

book = document.querySelectorAll("#booking");
for (let i = 0; i < book.length; i++) {
  const booked = book[i];
  booked.addEventListener('click',function(e){
      tripId = e.currentTarget.getAttribute("tripId");
      window.location = `auth/logined.inc.php?trip=${tripId}`;
      
  })
  
}