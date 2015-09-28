<?php
    $myfile = fopen("testfile.csv", "w");
    $txt = "Snack Name,Purchase Location\n";
    fwrite($myfile, $txt);
?>
    <div class="wrapper">
        <div class="content" role="main">
            <div class="shelf shelf_5">
                <h2 class="hdg hdg_1">Shopping List</h1>
            </div>
            <div class="shelf shelf_1">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Snack Name</th>
                            <th scope="col">Purchase Location</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($shoppinglist_sna as $sna_l)
                    {
                        $txt = "{$sna_l->name},{$sna_l->purchaseLocations} Location\n";
                        fwrite($myfile, $txt);                       
                    ?>
                        <tr>
                            <td><?=$sna_l->name?></td>
                            <td><?=$sna_l->purchaseLocations?></td>
                        </tr>
                    <?php
                    }
                    fclose($myfile); 
                    ?>
                    </tbody>
                </table>
            </div>
            <a href="<?=base_url()?>testfile.csv"><button class="btn">Export List</button></a>
        </div>
        <!-- /content -->
    </div>
    <!-- /wrapper -->

