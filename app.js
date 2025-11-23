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

// Form element ko select karo
const form = document.getElementById("solarForm");

// Message element ko select karo
const message = document.getElementById("confirmationMessage");

// Form submit event handle karo
form.addEventListener("submit", function(event) {
  event.preventDefault(); // Page reload nahi hona chahiye

  // Form submission ke baad message show karo
 setTimeout(()=>{
    message.style.display = "block";
    form.reset();
    setTimeout(()=>{
        message.style.display = "none";
    },3000)
 })
  
 }, 5000);

