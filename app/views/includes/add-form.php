<div class="add-post">
  <div class="add-post__title">
    <p>Create post</p>
  </div>
  <form action="<?php echo URLROOT; ?>/posts/add" method="POST" class="add-post__form">
    <textarea name="body" class="add-post__text" onkeyup="toggleBtn()"></textarea>
    <div class="add-post__btns">
      <div class="parent">
        <div class="file">
          <input class="file-input" type="file" id="file" />
          <span>Photo</span>
        </div>
      </div>
      <input id="post-submit" type="submit" value="Post" class="btn btn-success" disabled>  
    </div>
  </form>
</div>