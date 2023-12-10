document.getElementById('addTagButton').addEventListener('click', function () {
  var input = document.createElement('input');
  input.type = 'text';
  input.name = 'tags[]';
  input.placeholder = 'タグを入力';
  document.getElementById('tagContainer').appendChild(input);
});
