<div id="status" class="table-wrapper">
    <table>
        <tr>
            <th>User Name</th>
            <th>Common Name</th>
            <th>Real Host</th>
            <th>Virtual Address</th>
            <th>Bytes Rec/Sent</th>
            <th>Connected Since</th>
        </tr>
        <?php foreach ($statusData as $statusRow) : ?>
        <tr>
            <?php foreach ($statusRow as $statusColumn) : ?>

            <?php if (is_array($statusColumn)) : ?>
            <td 
                <?php foreach ($statusColumn[0] as $columnDataIndex => $columnData) : ?>
                    data-<?= $columnDataIndex ?>='<?= $columnData ?>'
                <?php endforeach; ?> 
            >
                <?= $statusColumn[1] ?>
            </td>
            <?php else : ?>
            <td>
                <?= $statusColumn ?>
            </td>
            <?php endif; ?>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>