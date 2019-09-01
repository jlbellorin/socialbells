<script>
  if (document.querySelector('#msg-flash')) {
    setTimeout(function() {
      document.querySelector('#msg-flash').style = 'display: none;';
      if ($_SESSION['success_msg']) {
        unset($_SESSION['success_msg']);
        unset($_SESSION['success_msg_class']);
      }
    }, 5000);
  }
</script>