<?php
if (isset($_POST['search'])) {
    include_once('../src/database/database.php');
    include_once('../src/helper/helper.php');

    $search = $_POST['search'];

    $sql = "SELECT * FROM member WHERE name LIKE '%" . $search . "%'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_object()) {
?>
        <tr>
            <td> <?php echo $row->name ?> </td>
            <td> <?php echo $row->address ?> </td>
            <td> <?php echo $row->city ?> </td>
            <td> <?php echo $row->telp ?> </td>
            <td>
                <form class="d-inline" action="delete_member.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row->id ?>">
                    <button type="submit" class="btn btn-danger btn-fab btn-icon btn-round">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
                <a href="edit_member.php?id=<?php echo $row->id ?>" class="btn btn-primary btn-fab btn-icon btn-round">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>
<?php }
} ?>