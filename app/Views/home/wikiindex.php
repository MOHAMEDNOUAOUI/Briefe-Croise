<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/assets/css/wikiindex.css">
</head>
<body>
    







    <div class="main row w-100">


<div class="left col-md-3">
    

    
    <table class="infobox" style="width:100%
">
            <tr class="w-100">
                <td colspan="2" style="text-align:center">
                <img class="w-100" src="data:image/jpeg;base64,<?php echo $data['wikiImage']; ?>" alt="">
                </td>
            </tr>


            <tr>
                <th scope="row" style="line-height:1.2em; padding-right:0.65em;">Tags
                <td style="line-height:1.35em;">
                    <div class="plainlist">
                        <ul>
                            <?php foreach ($data['tags'] as $tag => $value){
                                ?>
                                <li><code><?php echo $value['tagName']?></code></li>
                                <?php
                            }?>
                        </ul>
                    </div>
                </td>
            </tr>

            <tr>
                <th scope="row" style="line-height:1.2em; padding-right:0.65em;">Category
                <td style="line-height:1.35em;">
                   <?php echo $data['categoryName']?>
                </td>
            </tr>
            
          



            <tr>
                <th scope="row" style="line-height:1.2em; padding-right:0.65em;">Created&nbsp;by</th>
                <td style="line-height:1.35em;"><?php echo $data['userName']?></td>
            </tr>


            <tr>
                <th scope="row" style="line-height:1.2em; padding-right:0.65em;">Release date</th>
                <td style="line-height:1.35em;"><?php echo $data['release_date']?></td>
            </tr>



            
            
            
            
        </tbody>
    </table>

</div>




             <div class="right col-md-9">
             <h1 class="mt-0" style="word-wrap: break-word">

<?php

echo $data['wikiTitle'];
?>
</h1>
<hr>




<?php
if($data['userId'] == $_SESSION['userId']){
    ?>
    <div class="logos">
    <button>modify</button>
    <button onclick="deletewiki(<?php echo $data['wikiId']?>)">delete</button>
</div>

    <?php
}

?>
        <p>

<?php
echo $data['wikiText']
?>

        </p>

   
                
 
            </div>
             </div>
            


    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../../public/assets/js/wiki.js"></script>
    </body>
</html>