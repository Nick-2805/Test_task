<?php 
  $page = $_GET['page'];

  if (empty($page)){
    $page = 1;
  }

  $offset = ($page - 1 ) * 5;

  $mysqli = new mysqli("localhost", "root", "root", "test");

  $news = $mysqli->query("SELECT * FROM `news` order by `idate` DESC LIMIT 5 OFFSET $offset");

  $countPages = $mysqli->query("SELECT COUNT(`id`) FROM `news`");

  $count = $countPages->fetch_row()[0];//[566]

  $totalBtns = ceil($count / 5);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <style>

      *{
        box-sizing: border-box;
      }

      body {
        font-family: 'Open Sans', arial, sans-serif;
        background-color: #edefeb;
        font-size: 13px;

      }

      .container {
        width: 100%;
        max-width: 952px;
        margin: 10px auto;
        padding: 18px 16px;
        display: flex;
        flex-direction: column;
        background-color: #FFFFFF;
      }
      .header {
        margin: 0;
      }

      .news{
        padding: 20px 0 4px;
        border-top: 1px dotted #832b5b;
        border-bottom: 1px dotted #832b5b;
      }

      .news p {
        margin-top: 4px;
      }

      .block-new-header {
        display: flex;
        gap: 10px;
      }
      .block-new-header-data {
        padding: 0 5px;
        background-color: #832b5b;
        color: #EEEEEE;
      }

      .block-new-header a {
        color: #252af3
      }
      .pagination-title{
        margin: 10px 0 6px;
        font-weight: 600;
      }


      .pagination-items {
        display: flex;
        flex-wrap: wrap;
        gap:5px
      }

      .pagination-item {
        width: 28px;
        background-color: #edefeb;
        border: 1px solid #cccecb;
        text-align: center;
        text-decoration: none;
        color: #4d4f4c;
      }

      .pagination-item:hover {
        background-color: #832b5b;
        color: #EEEEEE;
      }
      .active {
        background-color: #832b5b;
        color: #EEEEEE;
      }
      
    </style>
  </head>
  <body>
  
    <div class="container">

      <h1 class="header">Новости</h1>

      <div class="news">
        <?php foreach ($news as $new) { ?>
          <div class="block-new">
            <div class="block-new-header">
              <div class="block-new-header-data"><?php echo date('d.m.Y', $new['idate']); ?></div>
              <div class="block-new-header-title">
                <a href="/view.php?id=<?php echo $new['id']; ?>"><?php echo $new['title']; ?></a>
              </div>
            </div>
      
            <div class="content">
              <p><?php echo $new['announce']; ?></p>
      
            </div>
          </div>
        <? } ?>
      </div>

      <div class="pagination">
        <div class="pagination-title">Страницы:</div>
        <div class="pagination-items">

          <?php for ($i = 1; $i <= $totalBtns; $i++) {?>
          <?php if($i==$page){?>
              <a href='/news.php?page=<?php echo $i; ?>' class="pagination-item active"><?php echo $i;?></a>
            <?}else {?> 
              <a href='/news.php?page=<?php echo $i; ?>' class="pagination-item"><?php echo $i;?></a>
            <?}?>
          <?} ?>

        </div>
      </div>
    </div>

  </body>
</html>