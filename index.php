<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '\dati.php';


$tax         = number_format((float) $dati['tax'], 3);
$taxImported = number_format((float) $dati['tax_imported'], 3);
$casi        = $dati['casi'];

$one   = $casi[1];
$twoo  = $casi[2];
$tree  = $casi[3];

?>
<div style="display: inline;float:left">
<?php
getTableResult($one, $tax, $taxImported,'One');
getTableResult($twoo, $tax, $taxImported,'Two');
getTableResult($tree, $tax, $taxImported,'Three');
?>
</div>

<?php
function getTableResult($array, $tax, $taxImported,$caso)
{
    $tx     = 0;
    $txImp  = 0;
    $total  = 0;
?>

    <table style="display: inline;float:left;margin-left:6vw">
    <thead>
        <tr>
            <th colspan="3" style="border: 1px solid black;">Caso <?php echo $caso ?></th>
        </tr>
    </thead>
        <?php
        foreach ($array as $key => $value) {
            if (!$value['no_tax']) {
                $tx = $tx + ((float) $value['price'] * $tax);
            }

            if ($value['imported']) {
                $txImp = $txImp + ((float) $value['price'] * $taxImported);
            }
            $total  = $total + ((float)$value['price'] * (int) $value['qta']);
        ?>
            <tr>
                <td><?php echo $value['qta'] ?></td>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['price'] ?></td>

            </tr>
        <?php
        }
        $taxFinal = round(($tx + $txImp) / 0.05) * 0.05;
        
        ?>
        <tr>
            <th></th>
            <th>Sales Tax: </th>
            <th><?php echo number_format($taxFinal, 2) ?></th>
        </tr>
        <tr>
            <th></th>
            <th>Total: </th>
            <th><?php echo number_format(($total + $taxFinal), 2) ?></th>
        </tr>
    </table>
<?php
}
