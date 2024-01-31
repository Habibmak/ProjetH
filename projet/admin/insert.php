<?php

    require 'connexion.php';


$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image ="";

if(!empty($_POST))
{
      $name                   =  checkInput($_POST['nom']);
      $description            =  checkInput($_POST['Description']);
      $price                  =  checkInput($_POST['Prix']);
      $category               =  checkInput($_POST['categorie']);
      $image                  =  checkInput($_FILES["image"]["name"]);
      $imagePath              =  '../images/'. basename($image);
      $imagesExtension        =  pathinfo($imagePath,PATHINFO_EXTENSION);
      $isSucsses              =  true;
      $isUploadSucces         =  false;
      

      if(empty($name))
      {
        $nameError = 'ce champ ne peut pas etre vide';
        $isSucsses = false;
      }
      if(empty($description))
      {
        $descriptionError = 'ce champ ne peut pas etre vide';
        $isSucsses = false;
      }
      if(empty($price))
      {
        $priceError = 'ce champ ne peut pas etre vide';
        $isSucsses = false;
      }
      if(empty($category))
      {
        $categoryError = 'ce champ ne peut pas etre vide';
        $isSucsses = false;
      }
      if(empty($image))
      {
        $imageError = 'ce champ ne peut pas etre vide';
        $isSucsses = false;
      }
      else
      {
        $isUploadSucces = true;
        if($imagesExtension  !="jpg" && $imagesExtension !="png" && $imagesExtension !="gif")
        {
          $imageError = "les fichers autorisés sont : .jpg, .jpeg, .png, .gif";
        }
        if(file_exists($imagePath))
        {
          $imageError = "le ficher existe déja";
          $isUploadSucces = false;
        }
        if($_FILES["image"]["size"] > 500000)
        {
          $imageError = "le fichier ne doit pas dépasser les 500KB";
          $isUploadSucces = false;
        }
        if($isUploadSucces)
        {
          if(!move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath))
          {
            $imageError = "il y a eu une erreur lors de l'installation";
            $isUploadSucces = false;
          }
        }
      }
      //   if($isSucsses  && $isUploadSucces)
      // {
      //   $db = Database ::connect();
      //   $statement = $db->prepare("INSERT INTO items(name,description,price,category,image) values(?, ?, ?, ?, ?,)");
      //   $statement ->execute(array($name,$description,$price,$category,$image));
      //   Database::disconnect();
      //   header("location: index.php");
      // }

      if($isSucsses && $isUploadSucces )
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO items (name,description,price,category,image) values(?, ?, ?, ?, ?)");
            $statement->execute(array($name,$description,$price,$category,$image));
            Database::disconnect();
            header("Location: index.php");
        }
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
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body style="background-image: url(../images/bg.png);">

<h1 class="fs-1 fw-bold text-center " style="color: #e7480f;"><i class="fa-solid fa-utensils fs-1 me-2" style="color: #ffdd00;"></i>BURGER CODE<i class="fa-solid fa-utensils fs-1 ms-2" style="color: #ffdd00;"></i><a class="btn btn-warning ms-3" href="insert.php">Ajouter</a></h1>
 <section class="bg-light rounded-4 w-75 mx-auto mt-5 p-5">
    <h1 class="fs-bold">Ajouter items</h1>
    <form action="insert.php" role="form" method="post" enctype="multipart/form-data">
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
  <label for="formFile" class="form-label fw-bold fs-4">Choisir une image</label>
  <input class="form-control" type="file" id="image" name="image">
  <span class="help-inline text-danger"><?php echo $imageError;?></span>
</div>
<div class="mb-3">
<button type="submit" class="btn btn-success my-3 me-2" ><i class="fa-solid fa-pencil me-2"></i>Ajouter</button>
<a class="btn btn-primary my-3 me-2" href="index.php"><i class="fa-solid fa-left-long me-2"></i>Retour</a>
    
  </div>
 </section>
    </form>
</body>
</html>