let faqBtns = document.querySelectorAll(".faq-question");

faqBtns.forEach(btn => {
  btn.addEventListener("click", () => {
    // sab se pehle active class toggle karo
    btn.classList.toggle("active");

    // answer open/close logic
    let answer = btn.nextElementSibling;
    if (answer.style.maxHeight) {
      answer.style.maxHeight = null;
    } else {
      document.querySelectorAll(".faq-answer").forEach(a => a.style.maxHeight = null);
      answer.style.maxHeight = answer.scrollHeight + "px";
    }
  });
});

//  responsive navbar
let hamburger = document.querySelector('.hamburger');
let nav = document.querySelector('.nav-menu');

hamburger.addEventListener('click', () => {
  nav.classList.toggle('open_nav_bar');
  hamburger.classList.toggle('active');
});

