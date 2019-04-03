<?php /** @var \App\DTO\EditDTO $data */ ?>

<h1>EDIT BOOK</h1>

<a href="profile.php">My Profile</a>

<form method="post">
    Book Title: <input type="text" value="<?= $data->getBook()->getTitle(); ?>" name="title" ><br/>
    Book Author: <input type="text" value="<?= $data->getBook()->getAuthor(); ?>" name="author" ><br/>
    Description: <textarea name="description"><?=$data->getBook()->getDescription();?></textarea><br/>
    Image URL: <input value="<?= $data->getBook()->getImage(); ?>" type="text" name="image" minlength="3"/><br/>
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
    <input type="submit" name="edit" value="Edit"/>
</form>
<br/>

<?php
$image = $data->getBook()->getImage();
$imageData = base64_encode(file_get_contents($image));
echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
?>