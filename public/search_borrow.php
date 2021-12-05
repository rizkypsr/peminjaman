<?php
if (isset($_POST['search'])) {
    include_once('../src/database/database.php');
    include_once('../src/helper/helper.php');

    $search = $_POST['search'];

    $sql = "SELECT * FROM borrow WHERE member_id LIKE '%" . $search . "%' OR book_id LIKE '%" . $search . "%'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_object()) {
?>
        <tr>
            <td> <?php echo $row->member_id ?> </td>
            <td> <?php echo $row->book_id ?> </td>
            <td> <?php echo $row->start_date ?> </td>
            <td> <?php echo $row->end_date ?> </td>
            <td>
                <form class="d-inline" action="delete_borrow.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row->id ?>">
                    <button type="submit" class="btn btn-danger btn-fab btn-icon btn-round">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
                <a href="edit_borrow.php?id=<?php echo $row->id ?>" class="btn btn-primary btn-fab btn-icon btn-round">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>
<?php }
} ?>