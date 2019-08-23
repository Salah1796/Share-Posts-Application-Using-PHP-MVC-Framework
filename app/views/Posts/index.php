<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash("postAdd_success");?>

<div class="jumbotron jumbotron-flud " style="padding-top:20px;padding-bottom:15px">

  <div class="row mb-3">
    <div class="col-md-6">
      <h1 >Posts</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>posts/add" class="btn btn-info pull-right">
        <i class="fa fa-pencil"></i> Add Post
      </a>
    </div>
  </div>
  <?php foreach($data['posts'] as $post) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title text-center text-capitalize text-secondary"><?php echo $post->title; ?></h4>
      <div class="bg-light p-2 mb-3">
        Written by <?php echo $post->name; ?> on <?php echo $post->postCreated; ?>
      </div>
      <p class="card-text"><?php echo $post->body; ?></p>
      <a href="<?php echo URLROOT; ?>posts/show/<?php echo $post->posId; ?>" class="btn btn-info">More</a>
    </div>
  <?php endforeach; ?>
  <div>
<?php require APPROOT . '/views/inc/footer.php'; ?>