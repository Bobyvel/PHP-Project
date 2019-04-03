<?php /** @var \App\DTO\BookDTO[] $data */ ?>

<h1>My Books</h1>
<a href="add_book.php">Add new book</a> | <a href="profile.php">My Profile</a>
<a href="logout.php">logout</a> <br /><br />
<table border="1">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php foreach ($data as $book): ?>
        <tr>
            <td><?=$book->getTitle()?></td>
            <td><?=$book->getAuthor()?></td>
            <td><?=$book->getName()?></td>

            <td><a href="edit.php?id=<?= $book->getBookId(); ?>">edit book</a></td>
            <td><a href="delete.php?task_id=<?=$book->getBookId()?>">delete book</a></td>

        </tr>
    <?php endforeach;?>
</table>