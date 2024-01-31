<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resto Makni</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="admin/style.css">
</head>
<body style="background-image: url(images/bg.png);">

<div class="container w-75 mt-5 rounded-3">
    <div class="row">
        <div class="col-m-3">
            <h1 class="fs-1 fw-bold text-center " style="color: #e7480f;"><i class="fa-solid fa-utensils fs-1 me-2" style="color: #ffdd00;"></i>BURGER CODE<i class="fa-solid fa-utensils fs-1 ms-2" style="color: #ffdd00;"></i></h1>
        </div>
    </div>
    <?php
    require "admin/connexion.php";
    $db=database::connect();
    echo' <nav>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">';
    $statement = $db->query("SELECT* FROM categories");
    $row=$statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($row as $cat)
    {
        if($cat['id']=='1')
        {
            echo'<li class="nav-item" role="presentation">';
            echo'<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-'.$cat['id'].'" type="button" role="tab" aria-controls="pills-home" aria-selected="true">'.$cat['name'].'</button>';
            echo'</li>';
        }
        else
        {
            echo'<li class="nav-item" role="presentation">';
            echo'<button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-'.$cat['id'].'" type="button" role="tab" aria-controls="pills-home" aria-selected="true">'.$cat['name'].'</button>';
            echo'</li>';
        }
    
        
    }
    echo '</ul>
    </nav>';

echo'<div class="tab-content" id="pills-tabContent">';
foreach($row as $cat)
    {
        if($cat['id']=='1')
        {
            echo'<div class="tab-pane fade show active" id="pills-'.$cat['id'].'" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">';
            echo'<div class="row">';
                        $statement = $db->prepare("SELECT * FROM items where items.category=?");

                        $statement-> execute(array($cat['id']));
                        while($item=$statement->fetch(PDO::FETCH_ASSOC))
                        {
                        echo'<div class="col-md-4">';
                            echo'<div class="card mt-4" style="width: 100%;">';
                             echo'<img src=" images/'.$item['image'].'" class="card-img-top bg-warning img-thumbnail" alt="...">';
                            echo'<div class="price"> '.number_format((float)$item['price'], 2, '.', '') .' '. '€</div>';
                            echo'<div class="card-body">';
                                echo'<h5 class="card-title">'. $item['name'].'</h5>';
                                echo'<p> '.$item['description'].'</p>';
                                echo'<a href="#" class="btn btn-danger" style="width: 100%;"><span class="fa-solid fa-cart-shopping"></i></span>Commander</a>';
                            echo'</div>';

                        echo'</div></div>';
                        }
                        
            
            echo'</div></div>';
        }
        else
        {
            echo'<div class="tab-pane fade show" id="pills-'.$cat['id'].'" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">';
            echo'<div class="row">';
                        $statement = $db->prepare("SELECT * FROM items where items.category=?");

                        $statement-> execute(array($cat['id']));
                        while($item=$statement->fetch(PDO::FETCH_ASSOC))
                        {
                        echo'<div class="col-md-4">';
                            echo'<div class="card mt-4" style="width: 100%;">';
                             echo'<img src=" images/'.$item['image'].'" class="card-img-top bg-warning img-thumbnail" alt="...">';
                            echo'<div class="price"> '.number_format((float)$item['price'], 2, '.', '') .' '. '€</div>';
                            echo'<div class="card-body">';
                                echo'<h5 class="card-title">'. $item['name'].'</h5>';
                                echo'<p> '.$item['description'].'</p>';
                                echo'<a href="#" class="btn btn-danger" style="width: 100%;"><span class="fa-solid fa-cart-shopping"></i></span>Commander</a>';
                            echo'</div>';

                        echo'</div></div>';
                        }
                        
            
            echo'</div></div>';
        }
    }

    ?>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>