 <script>
     const acordin = document.getElementsByClassName('contentBx');
     for (i = 0; i < acordin.length; i++) {
         acordin[i].addEventListener('click', function() {
             this.classList.toggle('active')
         })
     }
 </script>