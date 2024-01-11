<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/assets/css/register.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  </head>
  <body>
    <div class="main d-flex justify-content-center">
    <div class="main-block">
      <h1>Registration</h1>
      <div class="form">

        <label id="icon" for="email"><i class="fas fa-envelope"></i></label>
        <input type="text" name="email" id="email" placeholder="Email" required/>

        <label id="icon" for="username"><i class="fas fa-user"></i></label>
        <input type="text" name="username" id="username" placeholder="Name" required/>

        <label id="icon" for="password"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" name="password" id="password" placeholder="Password" required/>

        <label id="icon" for="verifypassword"><i class="fas fa-unlock-alt"></i></label>
        <input type="password" name="verifypassword" id="verifypassword" placeholder="Password" required/>

        <div class="btn-block">
          <p>If you have an account alread you can <a href="indexlogin">login from here</a>.</p>
          <button name="register" id="submit" href="/">Submit</button>
        </div>
        
</div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../public/assets/js/register.js"></script>
  </body>
</html>