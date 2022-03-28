<h1>Index users</h1>
<a class="light-blue" href="/users/create">Create user</a>
<table>
  <thead>
    <tr>
      <th>id</th>
      <th>name</th>
      <th>email</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) : ?>
      <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['name'] ?></td>
        <td><?= $user['email'] ?></td>
        <td style="display:flex;">
          <form action= method="POST">
            <a href="/users/<?= $user['id'] ?>" class="bg-blue white border" type="submit">SHOW</a>
          </form>
          <form action="/users/<?= $user['id'] ?>/edit" method="POST" style="margin: 0 4px">
            <button class="bg-green white" type="submit">EDIT</button>
          </form>
          <form action="/users/<?= $user['id'] ?>/delete" method="POST">
            <button class="bg-red white" type="submit">DELETE</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>