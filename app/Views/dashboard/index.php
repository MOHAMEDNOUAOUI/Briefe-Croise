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
                <a href="#" class="active">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-outlined">
                        face
                    </span>
                    <h3>Users List</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-outlined">
                        category
                    </span>
                    <h3>Categories</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-outlined">
                        style
                    </span>
                    <h3>Tags</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-outlined">
                        article
                    </span>
                    <h3>Articles</h3>
                </a>

                <a href="#">
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
                </select>
            </div>



            <div class="stats gap-3 justify-content-between d-flex">
                <div class="card1">
                    <h3>Total Users</h3>
                    <h1 class="text-danger">12</h1>
                </div>
                <div class="card1">
                    <h3>Total Categories</h3>
                    <h1 class="text-primary">12</h1>
                </div>
                <div class="card1">
                    <h3>Total Tags</h3>
                    <h1 class="text-warning">12</h1>
                </div>
                <div class="card1">
                    <h3>Total Wikis</h3>
                    <h1 class="text-success">12</h1>
                </div>
            </div>


            <div class="wikisinfos">
                <h2>wikis</h2>
                <div class="wikicontainer">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">    </th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </main>


        <section class="leftcorner">
            <div class="profile">
                profile
            </div>
        </section>
    </div>



    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>