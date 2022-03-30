<?php
require("./view/head.phtml");
?>
<script>

    function searchq(){
       
        var searchTxt = $("input[name='searchterm']").val();
        var bndCk = $("input[name='srchbnd']").prop("checked") ? 1 : 0;
        var albCk = $("input[name='srchalb']").prop("checked") ? 1 : 0;
        var sngCk = $("input[name='srchsng']").prop("checked") ? 1 : 0;
        $.post("search.php",{searchval: searchTxt,srchbnd: bndCk,srchalb: albCk,srchsng:sngCk},function(output){
            $("#output").html(output);
        });
        console.log(searchTxt);
    }
</script>
<div class="container pt-5 ">

    <h1 class="display-2" style="font-weight: bold; padding-top:7%">FIND</h1>
</div>

<div class="container">
    <form action= "find.php" class="row gx-3 gy-2 align-items-center" method="POST" autocomplete="off">
        <div class="col-sm-3">
            <label class="visually-hidden" for="specificSizeInputName">Find</label>
            <input type="text" class="form-control" id="specificSizeInputName" placeholder="Search" name="searchterm" onkeyup="searchq();">
        </div>
        <div class="col-auto">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="srchbnd" name="srchbnd" Checked onchange="searchq();">
                <label class="form-check-label" for="srchbnd">
                    Bands
                </label>
            </div>
        </div>
        <div class="col-auto">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="srchalb" name="srchalb" Checked onchange="searchq();">
                <label class="form-check-label" for="srchalb">
                    Albums
                </label>
            </div>
        </div>
        <div class="col-auto">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="srchsng" name="srchsng" onchange="searchq();">
                <label class="form-check-label" for="srchsng">
                    Songs
                </label>
            </div>
        </div>
    </form>

    <div class="row" id="output">
        
    </div>
</div>
<div id="filler"></div>
<?php
require("./view/footer.phtml");
?>