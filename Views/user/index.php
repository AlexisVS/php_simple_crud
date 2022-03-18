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
        <td>
          <form action="/users/<?= $user['id'] ?>/delete" method="post">
            <button class="bg-red white" type="submit">DELETE</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>