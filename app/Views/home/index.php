<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/assets/css/wiki.css">
</head>
  <body>
    
 <header>
  <div class="container">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark p-2">
    <img src="../public/assets/imgs/wiki.png" alt="" style="width:3rem">
    <a class="navbar-brand" href="">Wiki</a>
    
    <button class="navbar-toggler" data-bs-target="#x" data-bs-toggle="collapse"><span class="navbar-toggler-icon"></span></button>


    <ul id="x" class="navbar-nav collapse navbar-collapse">
              
    
    <div class="wrapper col-md-4 col-sm-12">
                
    <form role="search" class="disactive">
                      <input id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">

                      <div class="wrapper-box" style="z-index:100">
                
                      </div>


                    </form>
          </div>


    </ul>


    </nav>
  </div>
 </header>






<!-- end of nab bar -->

<?php
if(isset($_SESSION['userId'])){
  ?>
  <div class="container d-flex">
<button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn ms-auto me-5 mt-2 btn-primary">add wiki</button>
</div>
  <?php
}

?>


<!-- Modal -->
<div class="modal fade bg-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content"> 
      <div class="modal-body">


        <div class="top d-flex flex-column justify-content-center">

          <form method="POST" class="myForm" action="home/Upload" enctype="multipart/form-data">

            <div class="d-flex flex-column" id="uploadForm">

              <div class="drop-zone bg-dark d-flex justify-content-center align-items-center mb-3">
                <div style="height:10rem" class="drop-zone__prompt text-white d-flex flex-column align-items-center justify-content-center">
                  <ion-icon style="font-size:5rem" name="cloud-upload-outline"></ion-icon>
                  <span class="text-white">Drop your album cover</span>
                </div>
              </div>

              <input type="file" name="myFile" class="drop-zone__input mb-3" id="myFileInput" multiple>

              <div class="d-flex flex-column">
                <div class="mb-3">
                  <h4 id="titletext">Title:</h4>
                  <input type="text" name="title" id="titleinput" class="form-control">
                </div>

                <div class="mb-3">
                  <h4>Category</h4>
                  <select name="category" class="form-select">
                    <option value="" disabled selected hidden>Choose category</option>
                    <?php
                      foreach ($data['allcategorys'] as $category) {
                    ?>
                      <option value="<?php echo $category->__get('categoryId')?>"><?php echo $category->__get('categoryName')?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>

                <div class="mb-3">
                  <h4>Tags</h4>
                  <?php
                    foreach ($data['alltags'] as $tag) {
                  ?>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="tags[]" value="<?php echo $tag->__get('tagId')?>">
                      <label class="form-check-label" for=""><?php echo $tag->__get('tagName')?></label>
                    </div>
                  <?php
                    }
                  ?>
                </div>

              </div>

            </div>

            <div class="mb-3">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea type="text" class="form-control" name="text" id="message-text"></textarea>
            </div>

          </form>

        </div>

      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit">Submit</button>
      </div>
    </div>
  </div>
</div>
















<main class="width-75 h-auto px-5 mt-4">

  <div class="row gap-4 ">
    <div class="headline col-lg-12 col-md-12 col-sm-12 bg-dark text-light" style="height:16.5rem">
      <img src="../public/assets/imgs/wiki-1000.jpg" alt="">
      <div class="headlineoverlay"></div>
      <div class="headlineinfos">
      <h2>The most latest Articles in our website</h2>
      <p>Discover more of the world with us</p>
      </div>
    </div>

    <?php
    foreach($data['wikislatest'] as $wiki) {
      ?>
      <div onclick="headerlocation(<?php echo $wiki->__get('wikiId')?>)" data-key="<?php echo $wiki->__get('wikiId')?>" class="col-lg-3 wiki position-relative col-md-4 col-sm-6 bg-success mb-3" style="width:17rem;height:16.5rem">
      <img class="position-absolute wiki-image" src="data:image/jpeg;base64,<?php echo $wiki->__get('wikiImage') ?>">
      <div class="over"></div>
      <div class="position-absolute wiki-infos">
      <h3><?php echo $wiki->__get('wikiTitle')?></h3>
      <p><?php echo $wiki->__get('wikiText')?></p>
      </div>
      </div>
      <?php
    }
    ?>
  </div>
</main>




<section class="container-fluid mt-5">
  <div class="categorys row align-items-center justify-content-center">
    <?php
    foreach($data['categoryslatest'] as $category) {
      ?>
      <div class="col-md-2"><?php echo $category->__get('categoryName')?></div>
      <?php
    }
    
    ?>
  </div>
</section>






  <script src="../public/assets/js/wiki.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>









