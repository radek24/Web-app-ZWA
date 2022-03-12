<?php
require("./head.phtml");
?>
<div class="band-container">
    <div class="container pt-5 ">

        <h1 class="display-2" style="font-weight: bold; padding-top:10%">FAVORITE WORST NIGHTMARES</h1>
        <div class="text-muted">
            <h5>ARCTIC MONKEYS • 12 SONGS • 32 min</h5>
        </div>
    </div>

</div>
<div class="container pt-5 ">
    <div class="text-center">


    </div>
    <?php
    for ($i = 1; $i <= 12; $i++) {
        require(".\songCard.phtml");
    }
    ?>
</div>
</div>
</div>
<?php
require("./footer.phtml");
?>