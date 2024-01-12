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
    







    <div class="main row">


<div class="left col-md-3">
    
<h1 style="word-wrap: break-word">

<?php

echo $data['wikiTitle'];
?>
</h1>




<?php
if($data['userId'] == $_SESSION['userId']){
    ?>
    <div class="logos">
    <button>modify</button>
    <button>delete</button>
</div>
    <?php
}

?>







    
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
                            <?php foreach ($data['tags'] as $tag){
                                ?>
                                <li><code><?php echo $tag['tagName']?></code></li>
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



            <tr>
                <th scope="row" style="line-height:1.2em; padding-right:0.65em;"><a
                        href="/wiki/Software_release_life_cycle" title="Software release life cycle">Latest
                        release</a></th>
                <td style="line-height:1.35em;">
                    <div style="display:inline-block; padding:0.1em 0;line-height:1.2em;"><a rel="nofollow"
                            class="external text" href="https://html.spec.whatwg.org/">Living
                            Standard</a><br>(2021) </div>
                </td>
            </tr>
            
            
            
            
        </tbody>
    </table>

</div>




             <div class="right col-md-9">
            

             <h2>HTML Table</h2>
        <p>is the <a href="link">standard markup language </a>
            standar for documents designed to be displayed in a <a href="link"> web browser.</a>
            It can be assisted by technologies such as <a href="link"> Cascading Style Sheets</a> (CSS) and <a
                href="link">
                languages</a> such as <a href="link">JavaScript.</a></p>

   
                
 
            </div>
             </div>
            


    </div>
    </body>


</html>