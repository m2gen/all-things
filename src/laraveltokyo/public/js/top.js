function updateValue(value, postId) {
  document.getElementById('rangeValue-' + postId).innerText = value;
}


$(document).ready(function () {
  $('[id^=voteButton-]').click(function () {
    var postId = $(this).attr('id').split('-')[1];
    var voteCount = $('#voteRange-' + postId).val();
    vote(postId, voteCount);
  });
});

function vote(postId, voteCount) {
  $.ajax({
    url: '/vote/' + postId,
    type: 'POST',
    data: {
      'votes': voteCount
    },
    success: function (response) {
      alert(response.message);
      // 投票が成功したら票数を更新
      $('#votes-' + postId).text(response.newVoteCount);
    }
  });
}
