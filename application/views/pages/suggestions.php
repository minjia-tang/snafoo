<?php
//setcookie('SUGGESTION', '', time()-3600);
//if (!empty($_COOKIE['SUGGESTION'])) {
//    print_r ($_COOKIE['SUGGESTION']);       
//} 
//echo $suggestion;
if ($suggestion =="true") {
    $suggestion_status = "disabled";
    echo "<p style=\"color: red;\">You've made your suggestion this month.</p>"; 
} else {
    if (!empty($msg)) {
        echo $msg;    
    }    
    $suggestion_status = "";
}
?>
<script type="text/javascript">
$(document).ready( function ()
{
    $('#snackOptions').change(function()
    {
        if(this.value != 0) {
           $('#suggestionInput').attr("disabled",true);
           $('#suggestionLocation').attr("disabled",true);
        } else {
           $('#suggestionInput').attr("disabled",false); 
           $('#suggestionLocation').attr("disabled",false);
        }
    
    });
});
</script>
    <div class="wrapper">
        <div class="content" role="main">
            <div class="shelf shelf_5">
                <h2 class="hdg hdg_1">Suggestions</h1>
            </div>
            <div class="shelf shelf_2">
                <div class="error isHidden">You have attempted to add more than the allowed number of suggestions per month!
                    <br />There is a total of one allowed suggestion per month.</div>
                <div class="error isHidden">You have attempted to add a suggestion that already exists!</div>
                <div class="error isHidden">You have not completed information requested.</div>
            </div>
            <div class="content-centered">
                <div class="shelf shelf_2">
                    <form method="post" action="" class="form" novalidate>
                        <fieldset class="shelf shelf_2">
                            <div class="shelf shelf_2">
                                <div class="shelf">
                                    <label for="snackOptions">
                                        <h2 class="hdg hdg_2">Select a snack from the list</h2>
                                    </label>
                                </div>
                                <select name="snackOptions" id="snackOptions" <?=$suggestion_status?>>
                                    <option value="0">Select one or input a suggestion</option>
                                    <?php
                                    foreach ($suggest_sna as $sna_s) {
                                    ?>
                                    <option value="<?=$sna_s->id?>"><?=$sna_s->name?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </fieldset>
                        <div class="shelf shelf_5">
                            <p class="hdg hdg_1">or</p>
                        </div>
                        <fieldset class="shelf shelf_5">
                            <div class="shelf">
                                <label for="suggestionInput">
                                    <h2 class="hdg hdg_2">Enter new snack suggestion &amp; purchasing location</h2>
                                </label>
                            </div>
                            <div class="shelf">
                                <input type="text" id="suggestionInput" name="suggestionInput" placeholder="Snack Suggestion" <?=$suggestion_status?>/>
                            </div>
                            <div class="shelf">
                                <label for="suggestionLocation" class="isHidden">Location</label>
                                <input type="text" id="suggestionLocation" name="suggestionLocation" placeholder="Location" class="" <?=$suggestion_status?>/>
                            </div>
                        </fieldset>
                        <input type="hidden" name="submitted" value="true" />
                        <input type="submit" value="Suggest this Snack!" class="btn">
                    </form>
                </div>
            </div>
        </div>
        <!-- /content -->
    </div>
    <!-- /wrapper -->

