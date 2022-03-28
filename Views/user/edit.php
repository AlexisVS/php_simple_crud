<h1>Edit User</h1>
<form action="/users/<?= $user['id'] ?>/update" method="post">
  <input type="text" name="name" id="">
  <input type="email" name="email" id="" id="">
  <button type="submit">Submit</button>
</form>