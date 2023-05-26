document.addEventListener("DOMContentLoaded", function() {
  var openFormButton = document.getElementById("openFormButton");
  var overlay = document.getElementById("overlay");
  var loginForm = document.getElementById("loginForm");
  var tabs = document.querySelectorAll(".tab");
  var tabContents = document.querySelectorAll(".tab-content div");

  openFormButton.addEventListener("click", function() {
      overlay.classList.add("open");
      loginForm.classList.add("open");
  });

  overlay.addEventListener("click", function() {
      overlay.classList.remove("open");
      loginForm.classList.remove("open");
  });

  tabs.forEach(function(tab) {
      tab.addEventListener("click", function() {
          tabs.forEach(function(t) {
              t.classList.remove("active");
          });

          tab.classList.add("active");

          var tabData = tab.getAttribute("data-tab");
          tabContents.forEach(function(content) {
              if (content.id === tabData) {
                  content.style.display = "block";
              } else {
                  content.style.display = "none";
              }
          });
      });
  });
});
