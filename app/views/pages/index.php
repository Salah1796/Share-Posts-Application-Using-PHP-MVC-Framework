<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
    <?php flash("login_success");?>

    <h1 class="display-3">
    <?php if(isset($data))  echo $data['title']; else echo "SharePosts"; ?>
    </h1>
    <p class="lead">
    <?php if(isset($data))  echo $data['description']; else echo "simple Social Network"; ?>

    </p>
    </div>
  </div> 
  
<?php require APPROOT . '/views/inc/footer.php'; ?>
