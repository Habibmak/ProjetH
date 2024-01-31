<?php

    require 'connexion.php';

    if(!empty($_GET['id']))
    {
        $id =checkInput($_GET['id']);
    }


        
            $db = Database::connect();
            $statement = $db->prepare("SELECT items.id, items.name, items.description, items.price ,items.category, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id= ?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            Database::disconnect();
            
        

function checkInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-image: url(../images/bg.png);">

<h1 class="fs-1 fw-bold text-center " style="color: #e7480f;"><i class="fa-solid fa-utensils fs-1 me-2" style="color: #ffdd00;"></i>BURGER CODE<i class="fa-solid fa-utensils fs-1 ms-2" style="color: #ffdd00;"></i><a class="btn btn-warning ms-3" href="insert.php">Ajouter</a></h1>
 <section class="bg-light rounded-4 w-75 mx-auto mt-5 p-5">
    
    <div class="container admin">
        <div class="row">
            <div class="col-md-6">
                <h1 class="fs-bold">voir un item</h1>
                <form>
                    <div class="mb-3">
                        <label for="Prix" class="form-label fw-bold fs-3">Nom :</label>
                        <?php echo ' '.$item['name'];?>
                        
                    </div>
                    <div class="mb-3">
                        <label for="Prix" class="form-label fw-bold fs-3">Description :</label>
                        <?php echo ' '.$item['description'];?>
                        
                    </div>
                    <div class="mb-3">
                        <label for="Prix" class="form-label fw-bold fs-3">Prix :</label>
                        <?php echo ' '.number_format((float)$item['price'], 2, '.', ''). '€';?>
                        
                    </div>
                    <div class="mb-3">
                        <label for="Prix" class="form-label fw-bold fs-3">Categorie :</label>
                        <?php echo ' '.$item['category'];?>
                        
                    </div>
                    <div class="mb-3">
                        <label for="Prix" class="form-label fw-bold fs-3">Image :</label>
                        <?php echo ' '.$item['image'];?>
                        
                    </div>
                    <div class="mb-3">
                    <a class="btn btn-primary my-3 me-2" href="index.php"><i class="fa-solid fa-left-long me-2"></i>Retour</a>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
            <div class="card" style="width: 100%;">
            <img src="<?php echo '../images/'.$item['image'];?>" class="card-img-top bg-warning" alt="...">
            <div class="price"><?php echo ' '.number_format((float)$item['price'], 2, '.', ''). '€';?></div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $item['name'];?></h5>
                <p><?php echo $item['description'];?></p>
                <a href="#" class="btn btn-danger" style="width: 100%;"><span class="fa-solid fa-cart-shopping"></i></span>Commander</a>
            </div>
</div>
            </div>

        </div>
    </div>
</body>
</html>