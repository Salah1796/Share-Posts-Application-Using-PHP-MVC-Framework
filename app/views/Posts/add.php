<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>posts" class="btn btn-light "><i class="fa fa-backward"></i> Back</a>
      <div class="card card-body bg-light mt-5">
        <h2 class="text-center text-secondary">
        Add Post </h2>
        <br>
        <!-- <p>Please fill out this form to Add Post</p> -->
        <form action="<?php echo URLROOT; ?>posts/add" method="post">
          <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
          </div>
         <div class="form-group">
            <label for="body">Body:</label>
            <textarea  name="body" class="form-control   <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" ><?php echo $data['body'];?></textarea>
            <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>

          </div>
          <div class="form-group">
          <button type="submit" class=" form-control btn btn-primary btn-lg btn-block">Save</button>

</div>
          

         
        </form>
    
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>