<nav class="navbar d-flex flex-column navbar-expand-lg bg-body-tertiary">

<div class="w-100 d-flex justify-content-between px-4 align-items-center">
<a class="navbar-brand " href="">
      <div class="d-flex gap-2">
      <img src="../public/assets/IMGS/wiki.png" alt="" style="max-width:3rem">
      <h2>wiki</h2>
      </div>
  </a>
</div>

<div class="d-flex w-100 align-items-center justify-content-center">
<div class="wrapper w-75">
<form role="search" class="disactive">
      <input id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">

      <div class="wrapper-box" style="z-index:100">
 
      </div>


    </form>
</div>
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</div>

  
  <div class="collapse navbar-collapse mt-2 " id="navbarSupportedContent">
    <?php

    if(!isset($_SESSION['userId'])){
      ?>
      <div class="register">
    <a href="usercontroller/indexlogin">se connecter</a>
    <a href="usercontroller/indexregister">Creer un compte</a>
  </div>
      <?php
    }
    else {
      ?>
      <div class="d-flex align-items-center gap-3">
      <div class="register d-flex align-items-center justify-content-center">
    <p>logo profile</p>
    <button class="btn btn-light">logout</button>
  </div>
      </div>
      <?php
    }
    ?>
  </div>
  


</nav>