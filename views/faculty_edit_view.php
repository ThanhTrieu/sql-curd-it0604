<?php require("views/header.php"); ?>

<div class="content">
    <h1> CMS - BTEC</h1>
    <a class="btn btn-primary" href="./faculty.php"> List Faculty </a>
    <div class="row">
        <div class="col">

            <?php if (!empty($_SESSION['error_faculty'])) : ?>
                <ul class="my-3">
                    <?php foreach ($_SESSION['error_faculty'] as $error) : ?>
                        <li class="text-danger"><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="faculty.php?m=handle-add" method="post">
                <div class="mb-3">
                    <label class="form-label">CODE</label>
                    <input type="text" class="form-control" name="extra_id">
                </div>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Leader</label>
                    <input type="text" class="form-control" name="leader">
                </div>
                <div class="mb-3">
                    <label class="form-label">Open date</label>
                    <input type="date" class="form-control" name="open_date">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>

<?php require("views/footer.php"); ?>