<?php
require("./head.phtml");
?>
<div class="band-container">
  <div class="container pt-5 ">
    <div class="text-center">
      <h1 class="display-1" style="font-weight: bold; padding-top:10%">ARCTIC MONKEYS</h1>

      <div class="container ">
        <div class="row text-muted">
          <div class="col-sm-3 ">

          </div>
          <div class="col-sm-3 ">
            <h5>5 ALBUMS</h5>
          </div>
          <div class="col-sm-3">
            <h5>42 SONGS</h5>
          </div>
          <div class="col-sm-3 ">

          </div>
        </div>
      </div>

      <p class="lead py-5 ">Arctic Monkeys je čtyřčlenná anglická indie rocková hudební skupina z předměstí Sheffieldu. Jejich první dva singly <strong>„I Bet You Look Good on the Dancefloor“</strong> a <strong>„When the Sun Goes Down“</strong> se oba okamžitě po vydání staly jedničkou v britské singlové hitparádě
      </p>


    </div>
  </div>

</div>
<div class="container pt-5 ">
  <div class="text-center">
  </div>
  <?php
  for ($i = 1; $i <= 4; $i++) {
    require(".\AlbumCard.phtml");
  }
  ?>
</div>
</div>
</div>

<?php
require("./footer.phtml");


?>