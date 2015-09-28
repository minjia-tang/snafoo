<?php 


//unset($_COOKIE['VOTES']);
//setcookie('VOTES', '', time()-3600);
//if (!empty($_COOKIE['VOTES'])) {
//    print_r (unserialize($_COOKIE['VOTES']));    
//}
if (empty($total_votes)) {
    $total_votes = 0;
}
$remain_votes = 3-$total_votes;
if ($remain_votes == 0 )  {
    echo "<p style=\"color: red;\">You've already made all your 3 votes this month.</p>"; 
}


//echo "total votes count is ".$total_votes;
//print_r($votes);
//echo "result count is ".$result_count;

?>
    <div class="wrapper">
        <div class="content" role="main">
            <div class="shelf shelf_5">
                <h1 class="hdg hdg_1">Voting</h1>
            </div>
            <div class="shelf shelf_2">
                <p>You are able to vote for up to three selections each month.</p>
            </div>
            <div class="shelf shelf_2">
                <div class="voteBox">
                    <div class="voteBox-hd">
                        <h2 class="hdg hdg_3">Votes Remaining</h2>
                    </div>
                    <div class="voteBox-body">
                        <p class="counter counter_yellow"><?=$remain_votes?></p>
                    </div>
                </div>
            </div>
            <div class="shelf shelf_2">
                <p class="error isHidden">Opps! You have already voted the total allowed times this month.<br />Come back next month to vote again!</p>
            </div>
            <div class="split">
                <div class="shelf shelf_2">
                    <div class="shelf">
                        <h2 class="hdg hdg_2 mix-hdg_centered ">Snacks Always Purchased</h2>
                    </div>
                    <ul class="list list_centered">
                    <?php
                    if (!empty($always_sna)){
                        foreach ($always_sna as $sna)
                        {
                        ?>
                           <li><?=$sna->name?></li>
                        <?php
                        }                                                    
                    }
                    ?>
                    </ul>
                </div>
            </div>
            <div class="split">
                <div class="shelf shelf_2">
                    <div class="shelf">
                        <h2 class="hdg hdg_2 mix-hdg_centered ">Snacks suggested this month</h2>
                    </div>
                    <div class="shelf shelf_5">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Snack Food</th>
                                    <th scope="col">Current Votes</th>
                                    <th scope="col">VOTE</th>
                                    <th scope="col">Last Date Purchased</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($vote_sna as $sna_v)
                            {
                                if (!empty($sna_v->lastPurchaseDate)) {
                                    $purchsed_d = new DateTime($sna_v->lastPurchaseDate);
                                    $formatted_purchsed_d = $purchsed_d->format( 'm/d/y' );    
                                } else {
                                    $formatted_purchsed_d = "";
                                }
                                 
                                if (in_array($sna_v->vote_sna_id, $votes) || $remain_votes == 0) {
                                    $button_status = "disabled";
                                    $button_css = "icon-disabled";

                                } else {
                                    $button_status = "";
                                    $button_css = "icon-check_noVote";
                                }
                         
                            ?>                            
                            
                            
                                <tr>
                                    <td><?=$sna_v->name?></td>
                                    <td><?=$sna_v->vote_count?></td>
                                    <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="sna_id" value="<?=$sna_v->vote_sna_id?>" />
                                        <input type="hidden" name="submitted" value="true" />
                                        <button class="btn btn_clear" type="submit" <?=$button_status?>><i class="icon-check <?=$button_css?> "></i>
                                        </button>
                                    </form>
                                    </td>
                                    <td><?=$formatted_purchsed_d?></td>
                                </tr>
                            <?php
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /content -->
    </div>
    <!-- /wrapper -->

