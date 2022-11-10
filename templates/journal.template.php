<div id="journal" class="tabs-wrapper">
    <div class="tabs">
        <div class="tab-links">
            <button class="tab-link active" data-cname="all-clients" >*</button>
            <?php foreach ($names as $host => $name) : ?>
            <button class="tab-link" data-cname="<?= $host ?>" ><?= $name ?></button>
            <?php endforeach; ?>
        </div>

        <div id="all-clients" class="tab-content active">
            <ul>
            <?php foreach ($journalData as $event) : ?>
                <li class="<?= $event[0] ?>">
                    <span data-datetime='<?= $event[1] ?>' > null </span>
                    <span><?= $event[2] ?></span>
                    <span><?= $event[3] ?></span>
                    <span><?= $event[4] ?></span>
                </li>
            <?php endforeach; ?>
            <ul>
        </div>

        <?php foreach ($journalWithNames as $clientName => $clientEvents) : ?>
            <div id="<?= $clientName ?>" class="tab-content">
                <ul>
                <?php foreach ($clientEvents as $event) : ?>
                    <li class="<?= $event[0] ?>">
                        <span data-datetime='<?= $event[1] ?>' > null </span>
                    </li>
                <?php endforeach; ?>
                <ul>
            </div>
        <?php endforeach; ?>
    </div>
</div>