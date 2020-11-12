      
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>


  <script src="../assets/js/jquery.dataTables.min.js"></script>
  <script src="../assets/js/dataTables.buttons.min.js"></script>
  <script src="../assets/js/buttons.flash.min.js"></script>
  <script src="../assets/js/jszip.min.js"></script>
  <script src="../assets/js/pdfmake.min.js"></script>
  <script src="../assets/js/vfs_fonts.js"></script>
  <script src="../assets/js/buttons.html5.min.js"></script>
  <script src="../assets/js/buttons.print.min.js"></script>

  <script src="../assets/sweetalert/sweetalert2.min.js"></script>

  <script type="text/javascript">
    function Session_Close(){
      $.ajax({
          url:  "../functions/Login/LoginHandler.php",
          type: 'POST',
          data: {function:'login_close'},
          success: function(data){
            var datos = JSON.parse(data);
            if (datos == "ok") {
              window.location = "../index.php";
            }
          }
      });
    }
  </script>
