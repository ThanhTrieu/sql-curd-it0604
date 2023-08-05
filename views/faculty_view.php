<?php require("views/header.php"); ?>

<?php $state = $_GET['state'] ?? null; ?>

<div class="content">
    <h1> CMS - BTEC</h1>
    <a class="btn btn-primary" href="./faculty.php?m=add"> Add </a>
    <?php if($state === 'success'): ?>
        <p class="text-success mt-3"> Thao tac thanh cong !</p>
    <?php endif; ?>
    <?php if($state === 'fail'): ?>
        <p class="text-danger mt-3"> Thao tac that bai !</p>
    <?php endif; ?>
    <table class="table my-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Leader</th>
                <th scope="col">Open date</th>
                <th scope="col">Status</th>
                <th scope="col" colspan="2" width="5%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($faculties as $key => $item): ?>
            <tr>
                <th scope="row"><?= $item['extra_id']; ?></th>
                <td><?= $item['name']; ?></td>
                <td><?= $item['leader']; ?></td>
                <td><?= $item['open_date']; ?></td>
                <td>
                    <span class="badge bg-primary"><?= $item['status'] == 1 ? 'Active' : 'Inactive'; ?></span>
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="#"> Edit</a>
                </td>
                <td>
                    <form action="faculty.php?m=delete" method="post">
                        <input type="hidden" name="id" value="<?= $item['id']; ?>" >
                        <button name="btnDel" type="submit" class="btn btn-info btn-sm"> Delete</button>
                    </form>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require("views/footer.php"); ?>