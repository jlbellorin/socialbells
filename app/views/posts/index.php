
<?php require APPROOT . '/views/includes/header.php'; ?>
  <?php flash('post_message'); ?>
  <!-- ADD POSTS -->
  <?php require APPROOT . '/views/includes/add-form.php'; ?>
  <!-- END OF ADD POSTS -->
  <!-- POSTS -->
  <?php foreach ($data['posts'] as $post): ?>
    <div class="card card-body mb-3 posts">
      <div class="bg-light p-2 mb-3">
        <span>Posted by <strong><?php echo $post->name . ' ' . $post->last_name; ?></strong></span> <span><?php echo time_elapsed_string($post->postCreated); ?></span>
      </div>
      <p class="card-text"><?php echo $post->body; ?></p>
    </div>
    <?php require APPROOT . '/views/includes/unset_msg.php'; ?>
  <?php endforeach; ?>
  <!-- END OF POSTS -->
<?php require APPROOT . '/views/includes/footer.php'; ?>