fetch('/api/test')
.then(response  => response.json())
.then(users => console.log(users));

