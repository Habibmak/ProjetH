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


          

    <table class="table table-bordered mt-5">
        <thead>
          <tr>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Prix</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- <tr>
            <th scope="row"></th>
            <td>Mark</td>
            <td>Otto</td>
            <td>zzz</td>
            <td><button type="button" class="btn btn-success">Edit</button><button type="button" class="btn btn-danger">Delate</button></td>
          </tr>
          <tr>
            <th scope="row"></th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>zzz</td>
            <td><button type="button" class="btn btn-success">Edit</button><button type="button" class="btn btn-danger">Delate</button></td>
          </tr>
          <tr>
            <th scope="row"></th>
            <td>Larry the Bird</td>
            <td>@twitter</td>
            <td>zzz</td>
            <td><button type="button" class="btn btn-success">Edit</button><button type="button" class="btn btn-danger">Delate</button></td>
          </tr> -->
          <?php
          require 'connexion.php';
          $db=database::connect();
          $statement=$db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY items.id DESC' );
          while($item = $statement->fetch())
          {
            echo '<tr>';
            echo '<td>'.$item['name'].'</td>';
            echo '<td>'.$item['description'].'</td>';
            echo '<td>'. number_format($item['price'], 2, '.' , '').'</td>';
            echo '<td>'.$item['category'].'</td>';
            echo '<td width=300>';
            echo '<a type="button" class="btn btn-success me-2" href="update.php?id='.$item['id'].'"><i class="fa-solid fa-pencil me-2"></i>Edit</a>';
            echo '';
            echo '<a type="button" class="btn btn-danger me-2" href="delate.php?id='.$item['id'].'"><i class="fa-solid fa-trash me-2"></i>Delate</a>';
            echo '';
            echo '<a type="button" class="btn btn-info" href="view.php?id='.$item['id'].'"><i class="fa-regular fa-eye me-2"></i>View</a>';
            echo '</td';
            echo '</tr>';
          }
          database::disconnect();


          ?>
        </tbody>
      </table>


</body>
</html>