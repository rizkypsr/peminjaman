<?php
if (isset($_POST['search'])) {
    include_once('../src/database/database.php');
    include_once('../src/helper/helper.php');

    $search = $_POST['search'];

    $sql = "SELECT * FROM book WHERE title LIKE '%" . $search . "%'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_object()) {
?>
        <tr>
            <td> <?php echo $row->title ?> </td>
            <td>
                <img width="70" src="<?php echo getBaseUrl() ?>uploads/<?php echo $row->photo ?>">
            </td>
            <td> <?php echo $row->author ?> </td>
            <td> <?php echo $row->publication_year ?> </td>
            <td> <?php echo $row->created_at ?> </td>
            <td>
                <form class="d-inline" action="delete_book.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row->id ?>">
                    <button type="submit" class="btn btn-danger btn-fab btn-icon btn-round">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
                <a href="edit_book.php?id=<?php echo $row->id ?>" class="btn btn-primary btn-fab btn-icon btn-round">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>
<?php }
} ?>