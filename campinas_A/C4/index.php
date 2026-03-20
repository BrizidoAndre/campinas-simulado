<?php
/**
 * @var $jsons
 */
$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
$invalidJson = false;
// is form submiting
if ($isPost) {
    $jsonText = json_decode($_POST['json'] ?? 'invalid');
    $invalidJson = $jsonText === NULL;

    // is json valid
    if (!$invalidJson) {
        $jsons = [];
        // transforming each object in array
        foreach ($jsonText as $item) {
            $jsons[] = [
                    'title' => $item->title,
                    'start' => date_create_from_format('Y-m-d H:i:s', $item->start),
                    'end' => date_create_from_format('Y-m-d H:i:s', $item->end),
                    'priority' => $item->priority,
            ];
        }

        // sortering events
        usort($jsons, function ($a, $b) {
            return $a['end']->getTimestamp() > $b['end']->getTimestamp() ? 1 : -1;
        });

        global $filtered;

        $filtered = [];

        // removing booked events
        $finalScheduled = array_filter($jsons, function ($line) use ($filtered, $jsons) {
//            getting current time
            $endTime = $line['end']->getTimestamp();
            $startTime = $line['start']->getTimestamp();
//            loop to every item again
            foreach ($jsons as $json) {
                $endJson = $json['end']->getTimestamp();
                $startJson = $json['start']->getTimestamp();
                if ($startTime < $endJson && $endTime > $startJson) {
//                    if priority of overbooked is higher than current item
                    if ($json['priority'] > $line['priority']) {
                        return false;
                    } else {
                        $filtered[] = [
                                'removedTitle' => $line['title'],
                                'removedPriority' => $line['priority'],
                                'conflictWith' => $line['title'],
                        ];
                        return true;
                    }
                }
            }
//            if nothing is overbooking there is no need to remove
            return false;
        });
        foreach ($jsons as $line) {
            $endTime = $line['end']->getTimestamp();
            $startTime = $line['start']->getTimestamp();
//            loop to every item again
            foreach ($jsons as $json) {
                $endJson = $json['end']->getTimestamp();
                $startJson = $json['start']->getTimestamp();
                if ($startTime < $endJson && $endTime > $startJson) {
//                    if priority of overbooked is higher than current item
                    if ($json['priority'] < $line['priority']) {
                        $filtered[] = [
                                'removedTitle' => $line['title'],
                                'removedPriority' => $line['priority'],
                                'conflictWith' => $line['title'],
                        ];
                    }
                }
            }
        }
        array_shift($filtered);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timeline Conflict Resolver</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
<h1>Timeline Conflict Resolver</h1>
<form action="" method="post">
    <label for="json">Json text</label>
    <textarea name="json" id="" cols="30" rows="10" placeholder="Paste JSON here"></textarea>
    <button>Submit</button>
</form>
<?php if ($invalidJson): ?>
    <p class="error">Invalid JSON input: Syntax error</p>
<?php else: ?>
    <p class="error">Please submit JSON input.</p>
<?php endif ?>
<?php if (!$invalidJson && $isPost): ?>
    <h2>Original Events <?= count($jsons) ?></h2>
    <ul>
        <?php foreach ($jsons as $line) : ?>
            <li><?= $line['title'] ?> | <?= $line['start']->format('Y-m-d H:i:s') ?>
                - <?= $line['end']->format('Y-m-d H:i:s') ?> | Priority: <?= $line['priority'] ?></li>
        <?php endforeach ?>
    </ul>
    <h2>Final Events <?= count($finalScheduled) ?></h2>
    <ul>
        <?php foreach ($finalScheduled as $line) : ?>
            <li><?= $line['title'] ?> | <?= $line['start']->format('Y-m-d H:i:s') ?>
                - <?= $line['end']->format('Y-m-d H:i:s') ?> | Priority: <?= $line['priority'] ?></li>
        <?php endforeach ?>
    </ul>
    <h2>Removed Events:</h2>
    <ul class="error">
        <?php foreach ($filtered as $line) : ?>
            <li>
                <?= $line['removedTitle'] ?> (priority <?= $line['removedPriority'] ?>) - Conflicts
                with <?= $line['conflictWith'] ?>
            </li>
        <?php endforeach ?>
    </ul>
    <h2>JSON Output</h2>
    <pre>
        <?= $_POST['json'] ?>
    </pre>
<?php endif ?>
</body>
</html>