<?php 
  $mysqli = new mysqli("localhost", "root", "root", "test");
  $id = $_GET['id'];
  $new = $mysqli->query("SELECT * from `news` where `id`= $id");
  $new_data = $new->fetch_assoc();
?>

  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <style>

        *{
          box-sizing: border-box;
        }

        body {
          font-family: 'Open Sans', arial, sans-serif;
          background-color: #edefeb;
          font-size: 14px;
        }

        .container{
          width: 1055px;
          margin: 50px auto;
          padding: 10px 20px;
          display: flex;
          flex-direction: column;
          background-color: #FFFFFF;
        }

        .content{
          margin-bottom: 16px;
          border-top: 1px dotted #832b5b;
          border-bottom: 1px dotted #832b5b;
          font-size: 16px;
        }

        .container a {
          margin-bottom: 21px;
          font-size: 18px;
        }

      </style>
    </head>
    <body>
      <div class="container">
        <h1 class='title'><?php echo $new_data[title];?></h1>
        <div class="content"><?php echo $new_data[content];?></div>
        <a href="/news.php">Все новости &nbsp; >></a>
      </div>
    </body>
  </html>
  