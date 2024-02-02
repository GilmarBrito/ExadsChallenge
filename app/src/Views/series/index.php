<?php
require_once dirname(__DIR__) . '/header.php';
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2" style="margin-top:100px">
                <h2>Séries de TV</h2>
                <form action="/series" method="post">
                    <div class="row">
                        <div class="form-group col mb-3">
                            <label class="control-label">Pick a date and time</label>
                            <input type="datetime-local" name="date_time" value="<?= $data['datetime'] ?>" format-value="yyyy-MM-ddTHH:mm" class="form-control" />
                        </div>

                        <div class="form-group col mb-3">
                            <label class="control-label">Select a show:</label>
                            <select class="form-select" name="series" aria-label="Default select example">
                                <option value="0" <?= $data['series_value'] === 0 ? 'selected' : '' ?>>Todos</option>
                                <?php foreach ($data['series_name'] as $row) { ?>
                                    <option value="<?= $row['id'] ?>" <?= $data['series_value'] === $row['id'] ? 'selected' : '' ?>><?= $row['title'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Channel</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Week Day</th>
                            <th scope="col">Show Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        Teste
                        <?php foreach ($data['tv_series'] as $row) { ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['channel'] ?></td>
                                <td><?= $row['gender'] ?></td>
                                <td><?= $data['week_days'][$row['week_day']] ?></td>
                                <td><?= date('h:i A', strtotime($row['show_time'])); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
require_once dirname(__DIR__) . '/footer.php';
?>