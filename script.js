const form = document.querySelector("form");
form.addEventListener("submit", function(event) {
  event.preventDefault();
  const input = form.querySelector("input");
  const searchTerm = input.value;
  // Perform the search here, such as sending an API request or searching an array
  console.log(`Searching for: ${searchTerm}`);

});
const scrollTopBtn = document.getElementById("scrollTopBtn");

window.onscroll = function() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    scrollTopBtn.style.display = "block";
  } else {
    scrollTopBtn.style.display = "none";
  }
};

scrollTopBtn.addEventListener("click", function() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
});

