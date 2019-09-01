function toggleBtn () {
  if (document.querySelector('.add-post__text').value.length > 0) {
    document.querySelector('#post-submit').removeAttribute('disabled');
    console.log('HOlaaaa1111111111');
  }
  if (document.querySelector('.add-post__text').value.length == 0) {
    document.querySelector('#post-submit').setAttribute('disabled', true); 
  }
}