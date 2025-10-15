<style>
.login-wrapper {
  width: 300px;
  background-color: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  margin: 40px auto; 
}

.login-header {
  background-color: #333;
  padding: 10px;
  border-bottom: 1px solid #ddd;
  border-radius: 10px 10px 0 0;
}

.login-header h2 {
  margin: 0;
  color: #fff;
}

.login-body {
  padding: 20px;
}

.form-group {
  margin-bottom: 20px;
}

.icon {
  width: 40px;
  height: 40px;
  line-height: 40px;
  text-align: center;
  background-color: #87CEEB;
  color: #fff;
  border-radius: 50%;
  font-size: 18px;
  margin-right: 10px;
}

.form-group label {
  display: block;
  margin-bottom: 10px;
}

.form-group input[type="text"], .form-group input[type="password"] {
  width: 100%;
  height: 40px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.show-password {
  margin-bottom: 20px;
}

.show-password input[type="checkbox"] {
  margin-right: 10px;
}

.login-btn {
  width: 100%;
  height: 40px;
  background-color: #333    ;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.login-btn:hover {
  background-color: #66CCCC;
}

.error {
  color: #red;
  margin-bottom: 20px;
}

.error{
  color: red;
}
</style>

<div class="login-wrapper">
  <div class="login-header">
    <center><h2>Login</h2></center>
  </div>
  <div class="login-body">
    <form method="POST" action="login_check.php">
      <?php if (isset($_GET['error'])){
        echo "<center><p class='error'>Invalid Username or Password</p><p class='error'>Please Try Again</p></center>";
        
        } ?>
  
      <div class="form-group">
        <span class="icon"><i class="fas fa-user"></i></span>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="Username"><br>

        <span class="icon"><i class="fas fa-lock"></i></span>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Password">
      </div>
      <div class="show-password">
        <input type="checkbox" id="checkbox" onclick="togglePasswordVisibility()">
        <label for="checkbox">Show password</label>
      </div>
      <button type="submit" class="login-btn">Login</button>
    </form>
  </div>
</div>

<script>
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var showPasswordCheckbox = document.querySelector("#checkbox");
    if (showPasswordCheckbox.checked) {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  }
</script>