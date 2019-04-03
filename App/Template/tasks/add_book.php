<?php /** @var \App\DTO\EditDTO $data */ ?>

<h1>ADD NEW BOOK</h1>

<a href="profile.php">My Profile</a>

<form method="post">
    Book Title: <input type="text" name="title" /><br />
    Book Author: <input type="text" name="author" ><br/>
    Description: <textarea name="description"></textarea><br/>
    Image URL: <input  type="text" name="image" minlength="3"/><br/>
    Genre: <select name="genre_id">
        <?php foreach ($data->getGenres() as $book): ?>
            <?php if ($data->getBook()->getGenreId() == $book->getGenreId()): ?>
                <option selected="selected" value="<?= $book->getGenreId(); ?>"><?= $book->getName(); ?></option>
            <?php else: ?>
                <option value="<?= $book->getGenreId(); ?>"><?= $book->getName(); ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select><br/>
    <input type="hidden" value="" name="added_on"/><br/>
    <input type="submit" name="add" value="Add"/>
</form>
<br/>
