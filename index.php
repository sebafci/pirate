<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"  href="styles/style.css">
    <title>crud_pirate</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">CRUD <br>"bdd=tipiac""table=pirate"</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item mx-2">
        <a class="nav-link btn btn-outline-info btn-lg" href="index.php?read">Read <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link btn btn-outline-info btn-lg" href="index.php?create">Create</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link btn btn-outline-info btn-lg" href="index.php?update">Update</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link btn btn-outline-info btn-lg" href="index.php?del">Delete</a>
      </li>
    </ul>
  </div>
</nav>

<div class="text-center mt-5">
    <h1>Pirate</h1>
    <img src=".\img\pirate.jpg" alt="">
</div>

<?php
include 'includes/db.php';	
include 'includes/form.php';
include 'includes/formulaireUpdate.php';
echo $_POST['name'];

if(isset($_GET['read'])){
    echo "c'est le read. " . '</br>';
    $sql = 'SELECT * FROM pirate';
    $prepare = $db->prepare($sql);
    $prepare->execute();
    $list = $prepare->fetchAll();
    foreach($list as $value){
      ?><a href="index.php?id=<?php echo $value['id'];?>">id</a><?php
        echo $value['id'];
        echo $value['name'] . '</br>';
    }
}

if(isset($_GET['create'])){
    echo "c'est le create";
    $sql = "INSERT INTO `pirate` (`name`,`image`) VALUES (:name1,:image1)";
    $prepare = $db->prepare($sql);
    $prepare->execute([
        'name1'=> $_POST['name'],
        'image1'=> $_POST['image']
    ]);
}

if(isset($_POST['updateform'])){
    echo "c'est l'update";
    $sql = "UPDATE `pirate` SET `name`=:name1 , `image`=:image1 WHERE `id`=:id";
    $prepare = $db->prepare($sql);
    $test = $prepare->execute([
        'id' => $_GET['id'],
        'name1' => $_POST['name'],
        'image1' => $_POST['image']
    ]);
    //var_dump($test);
}

if(isset($_POST['delete'])){
    echo "c'est le Delete";
    $sql = "DELETE FROM `pirate` WHERE `id`= :id";
    $prepare = $db->prepare($sql);
    $test = $prepare->execute([
        'id' => $_GET['id']
  ]);
}
?>

</body>
</html>