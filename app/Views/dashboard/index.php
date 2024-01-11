<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="../public/assets/css/dashboard.css">
</head>

<body>


    <div class="container m-0">
        <aside>
            <div class="top">
                <div class="logo d-flex align-items-center justify-content-center gap-2">
                    <img src="../public/assets/IMGS/wiki.png" alt="">
                    <h3>Wiki™</h3>
                </div>
                <div class="close">
                    <ion-icon name="close-outline"></ion-icon>
                </div>
            </div>

            <div class="sidebar d-flex flex-column">
                <a href="" class="active">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>

                <a href="dashboard/user">
                    <span class="material-symbols-outlined">
                        face
                    </span>
                    <h3>Users List</h3>
                </a>

                <a href="dashboard/category">
                    <span class="material-symbols-outlined">
                        category
                    </span>
                    <h3>Categories</h3>
                </a>

                <a href="dashboard/tags">
                    <span class="material-symbols-outlined">
                        style
                    </span>
                    <h3>Tags</h3>
                </a>

                

                <a href="dashboard/logout">
                    <span class="material-symbols-outlined">
                        logout
                    </span>
                    <h3>logout</h3>
                </a>
            </div>


        </aside>

        <!-- main content -->
        <main>

            <h1>Analytics</h1>

            <div class="selections">
                <select name="" id="">
                    <option value="">
                            <h3>ALL</h3>
                    </option>
                    <?php
                    foreach($data['category'] as $category) {
                        ?>
                        <option value=""><?php echo $category->__get('categoryName')?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>



            <div class="stats gap-3 justify-content-between d-flex">
                <div class="card1">
                    <h3>Total Users</h3>
                    <h1 class="text-danger"><?php echo $data['USERSTATS']?></h1>
                </div>
                <div class="card1">
                    <h3>Total Categories</h3>
                    <h1 class="text-primary">
                        <?php echo $data['categorystats']?>
                    </h1>
                </div>
                <div class="card1">
                    <h3>Total Tags</h3>
                    <h1 class="text-warning"><?php echo $data['TAGSSTATS']?></h1>
                </div>
                <div class="card1">
                    <h3>Total Wikis</h3>
                    <h1 class="text-success"><?php echo $data['WIKISTATS']?></h1>
                </div>
            </div>


            <div class="wikisinfos">
                <h1>Articles</h1>
                <div class="wikicontainer">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Auteur</th>
                                <th scope="col">Category</th>
                                <th scope="col">Tags</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

            foreach($data['ALLWIKIS'] as $wikiUserPair){
                $wiki = $wikiUserPair['WIKI'];
                $user = $wikiUserPair['USER'];
                $category = $wikiUserPair['CATEGORY'];
                ?>
                <tr>
                                <th scope="row"><?php echo $wiki->__get('wikiId')?></th>
                                <td><?php echo $wiki->__get('wikiTitle')?></td>
                                <td><?php echo $user?></td>
                                <td><?php echo $category?></td>
                                <td>@mdo</td>
                                <?php
                                if($wiki->__get('wikiStatus') == 'active') {
                                    ?>
                                    <td><button value="<?php echo $wiki->__get('wikiId')?>" class="btn btnstatus btn-success"><?php echo $wiki->__get('wikiStatus')?></button></td>
                                    <?php
                                }
                                else {
                                    ?>
                                    <td><button value="<?php echo $wiki->__get('wikiId')?>" class="btn btnstatus btn-danger"><?php echo $wiki->__get('wikiStatus')?></button></td>
                                    <?php
                                }
                                ?>
                            </tr>
                <?php
            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </main>


        <section class="rightcorner m-0 p-0">
            <div class="profile d-flex">
                <div class="info">
                    <p class="m-0 p-0">Hey, <b><?php echo $data['USERNAME']?></b></p>
                    <small>Admin</small>
                </div>
                <div class="profile-photo">
                    <img src="../public/assets/IMGS/wiki.png" alt="">
                </div>
            </div>
        </section>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/assets/js/dashboard.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>