fetch('/api/test')
  .then(response => response.json())
  .then(users => console.log(users));

$.ajax({
    url: '/api/test',
    // method: 'POST',
    dataType: 'json',
    data: {
        id: 1        
    },
    success: function (user) {
        console.log(user)
    },
    error: function (response) {
        console.log(response);
    }
})