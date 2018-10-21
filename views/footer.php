
<footer class="footer">

<div class="container">

<p>&copy; My Website 2018 </p>

</div>

</footer>

    <script
      src="https://code.jquery.com/jquery-3.3.1.js"
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous"></script>

      <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="alert alert-danger" id="loginAlert"></div>
      <form>
        <input type="hidden" id="loginActive" name="loginActive" value="1">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Email address">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <a id="toggleLogin"> Sign up </a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="loginSignupButton" class="btn btn-primary">Login</button>
      </div>
    </div>
  </div>
</div>

<script>

    $("#toggleLogin").click(function(){

        if($("#loginActive").val() == "1") {

          $("#loginActive").val("0");
          $("#exampleModalLongTitle").html("Sign up");
          $("#loginSignupButton").html("Sign up");
          $("#toggleLogin").html("Login");
        
        } else {

          $("#loginActive").val("1");
          $("#exampleModalLongTitle").html("Login");
          $("#loginSignupButton").html("Login");
          $("#toggleLogin").html("Sign up");

        }

  })

    $("#loginSignupButton").click(function(){

      $.ajax({
        type: "POST",
        url: "views/actions.php?action=loginSignup",
        data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
        success: function(result) {
         if (result == "1") {

           window.location.assign("http://localhost/twitterclone/?page=publicprofiles");

         } else {

           $("#loginAlert").html(result).show();

         }

        }


      })

    })



</script>
  </body>
</html>

