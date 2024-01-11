<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../../public/assets/css/dashboard.css">
</head>

<body>


    <div class="container m-0">
        <aside>
            <div class="top">
                <div class="logo d-flex align-items-center justify-content-center gap-2">
                    <img src="../../public/assets/IMGS/wiki.png" alt="">
                    <h3>Wiki™</h3>
                </div>
                <div class="close">
                    <ion-icon name="close-outline"></ion-icon>
                </div>
            </div>

            <div class="sidebar d-flex flex-column">
                <a href="../dashboard">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>

                <a href="" class="active">
                    <span class="material-symbols-outlined">
                        face
                    </span>
                    <h3>Users List</h3>
                </a>

                <a href="../dashboard/category">
                    <span class="material-symbols-outlined">
                        category
                    </span>
                    <h3>Categories</h3>
                </a>

                <a href="../dashboard/tags">
                    <span class="material-symbols-outlined">
                        style
                    </span>
                    <h3>Tags</h3>
                </a>

                

                <a href="../dashboard/logout">
                    <span class="material-symbols-outlined">
                        logout
                    </span>
                    <h3>logout</h3>
                </a>
            </div>


        </aside>

        <!-- main content -->
    <main>
        <h1>Users</h1>
    <div class="right">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">UserName</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    
   
    <?php
    foreach($data['ALLUSERS'] as $user) {
        ?>
        <tr>
      <th scope="row"><?php echo $user->__get('userId')?></th>
      <td><?php echo $user->__get('userName')?></td>
      <td><?php echo $user->__get('userEmail')?></td>
    </tr>
        <?php
    }
    ?>
  </tbody>
</table>
    </div>
    </main>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/assets/js/dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>