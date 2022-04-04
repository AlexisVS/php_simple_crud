<h1 class="text-3xl">Index users</h1>
<?php

use Source\Helper;

if ($_SESSION) {
  Helper::beautifful_print($_SESSION);
}

?>

<?php if ($_SESSION['user']) : ?>
  <div class="w-full rounded py-3 border-2 border-green-500 bg-green-300 text-green-700 flex items-center">
    <p class="pl-6 font-semibold">Utilisateur connecter</p>
  </div>
<?php endif ?>
<a class="light-blue" href="/users/create">Create user</a>
<table>
  <thead>
    <tr>
      <th>id</th>
      <th>name</th>
      <th>email</th>
      <th>password</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) : ?>
      <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['name'] ?></td>
        <td><?= $user['email'] ?></td>
        <td class="text-green-400"><?= $user['password'] ?></td>
        <td class="flex space-x-2 items-center justify-between">
          <form action=method="POST">
            <a href="/users/<?= $user['id'] ?>" class="bg-blue-600 text-white p-1 border-1" type="submit">SHOW</a>
          </form>
          <form action="/users/<?= $user['id'] ?>/edit" method="POST">
            <button class="bg-green-500 text-white p-1" type="submit">EDIT</button>
          </form>
          <form action="/users/<?= $user['id'] ?>/delete" method="POST">
            <button class="bg-red-500 text-white p-1" type="submit">DELETE</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>