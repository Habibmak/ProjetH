<?php

    require 'connexion.php';

    if(!empty($_GET['id']))
    {
        $id =checkInput($_GET['id']);
    }
    if(!empty($_POST))
    {
            $id = checkInput($_POST['id']);
            $db = Database::connect();
            $statement = $db->prepare("DELETE FROM items WHERE id= ?");
            $statement->execute(array($id));
            Database::disconnect();
            header("Location: index.php");
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
            
                <h1 class="fs-bold">Supprimer un item</h1>
                <form action="delate.php" role="form" method="post">
                <input type="hidden" class="form-control w-75" id="Prix" name="id" value="<?php echo $id;?>">
                <div class="alert alert-warning" role="alert">
                    voullez vous supprimer?
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-success my-3 me-2" ><i class="fa-solid fa-pencil me-2"></i>Oui</button>
                    <a class="btn btn-primary my-3 me-2" href="index.php"><i class="fa-solid fa-left-long me-2"></i>Non</a>
    
                </div>
                </form>
            
        </div>
    </div>

</body>
</html>