<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash("postAdd_success");?>

<div class="jumbotron jumbotron-flud " style="padding-top:20px;padding-bottom:15px">

  
    <div class="card card-body mb-3">
      <h4 class="card-title  text-capitalize"><?php echo $data['post']->title; ?></h4>
      <div class="bg-secondary p-2 mb-3">
        Written by <?php echo $data['post']->name; ?> on <?php echo $data['post']->postCreated; ?>
      </div>
      <p class="card-text "><?php echo $data['post']->body; ?></p>
    </div>

  <div>
  <?php if($data['post']->user_id == $_SESSION['user_id']) :?>
  <a href="<?php echo URLROOT; ?>posts/edit/<?php echo $data['post']->posId; ?>" class="btn btn-dark">Edit</a>
  <a class="pull-right btn  btn-danger" href="<?php echo URLROOT; ?>posts/delete/<?php echo $data['post']->posId; ?>" >Delete</a>
<?php endif;?>
<?php require APPROOT . '/views/inc/footer.php'; ?>