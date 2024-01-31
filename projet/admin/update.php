<?php
    require 'connexion.php';
    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }
    $nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";
    if(!empty($_POST))
    {
        $name                   =  checkInput($_POST['nom']);
        $description            =  checkInput($_POST['Description']);
        $price                  =  checkInput($_POST['Prix']);
        $category               =  checkInput($_POST['categorie']);
        $image                  =  checkInput($_FILES["image"]["name"]);
        $imagePath              =  '../images/'. basename($image);
     
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        if(empty($name))
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($description))
        {
            $descriptionError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($price))
        {
            $priceError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($category))
        {
            $categoryError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($image)) // le input file est vide, ce qui signifie que l'image n'a pas ete update
        {
            $isImageUpdated = false;
        }
        else
        {
            $isImageUpdated = true;
            $isUploadSuccess =true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" )
            {
                $imageError = "Les fichiers autorises sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath))
            {
                $imageError = "Le fichier existe deja";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000)
            {
                $imageError = "Le fichier ne doit pas depasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess)
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                }
            }
        }
        if (($isSuccess && $isImageUpdated && $isUploadSuccess)
        || ($isSuccess && !$isImageUpdated))
        {
            $db = Database::connect();
            if($isImageUpdated)
            {
                $statement = $db->prepare("UPDATE items  set name = ?,
                description = ?, price = ?, category = ?, image = ?
                 WHERE id = ?");
                $statement->execute(array($name,$description,
                $price,$category,$image,$id));
            }
            else
            {
                $statement = $db->prepare("UPDATE items  set name = ?, description = ?, price = ?, category = ? WHERE id = ?");
                $statement->execute(array($name,$description,$price,$category,$id));
            }
            Database::disconnect();
            header("Location: index.php");
        }
        else if($isImageUpdated && !$isUploadSuccess)
        {
            $db = Database::connect();
            $statement = $db->prepare("SELECT * FROM items where id = ?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            $image          = $item['image'];
            Database::disconnect();
        }
    }
    else
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM items where id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $name           = $item['name'];
        $description    = $item['description'];
        $price          = $item['price'];
        $category       = $item['category'];
        $image          = $item['image'];
        Database::disconnect();
    }
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
            <form action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="nom" class="form-label fw-bold fs-3">Nom :</label>
    <input type="text" class="form-control w-75" id="nom" name="nom" placeholder="Nom" value="<?php echo $name;?>">
    <span class="help-inline text-danger"><?php echo $nameError;?></span>
</div>
<div class="mb-3">
    <label for="Description" class="form-label fw-bold fs-3">Description :</label>
    <input type="text" class="form-control w-75" id="Description" name="Description" placeholder="Description" value="<?php echo $description;?>">
    <span class="help-inline text-danger"><?php echo $descriptionError;?></span>
    </div>
    <div class="mb-3">
    <label for="Prix" class="form-label fw-bold fs-3">Prix :</label>
    <input type="text" class="form-control w-75" id="Prix" name="Prix" placeholder="Prix" value="<?php echo $price;?>">
    <span class="help-inline text-danger"><?php echo $priceError;?></span>
    </div>
    <div class="mb-3">
    <label for="nom" class="form-label fw-bold fs-3">Categorie :</label>
    <select class="form-select w-75" aria-label="Default select example" name="categorie">
      <?php
      $db = Database::connect();
      foreach ($db->query('SELECT * FROM categories') as $row)
      {
        echo '<option value="'. $row['id'].'">'.$row['name'] .'</option>';
      }
      Database::disconnect();
      ?>
       <span class="help-inline text-danger"><?php echo $categoryError;?></span>
    </select>
    </div>

    <div class="mb-3">
      <label for="image">image:</label><p><?php echo $image;?></p>
  <label for="formFile" class="form-label fw-bold fs-4">selectionner une nouvelle image</label>
  <input class="form-control" type="file" id="image" name="image">
  <span class="help-inline text-danger"><?php echo $imageError;?></span>
</div>
<div class="mb-3">
<button type="submit" class="btn btn-success my-3 me-2" ><i class="fa-solid fa-pencil me-2"></i>Modifier</button>
<a class="btn btn-primary my-3 me-2" href="index.php"><i class="fa-solid fa-left-long me-2"></i>Retour</a>
    
  </div>

    </form>
            </div>
            <div class="col-md-6">
            <div class="card" style="width: 100%;">
            <img src="<?php echo '../images/'.$item['image'];?>" class="card-img-top bg-warning" alt="...">
            <div class="price"><?php echo ' '.number_format((float)$price, 2, '.', ''). '€';?></div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $name;?></h5>
                <p><?php echo $description;?></p>
                <a href="#" class="btn btn-danger" style="width: 100%;"><span class="fa-solid fa-cart-shopping"></i></span>Commander</a>
            </div>
</div>
            </div>

        </div>
    </div>
</body>
</html>