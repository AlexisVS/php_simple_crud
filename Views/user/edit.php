<h1>Edit User</h1>
<form action="/users/<?= $user['id'] ?>/update" method="post">
  <input type="text" name="name" placeholder="name">
  <input type="email" name="email" placeholder="email">
  <input type="password" name="password" placeholder="password" />
  <button type="submit">Submit</button>
</form>