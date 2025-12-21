<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success text-center">
      <strong>
        {$LANG.supportticketsticketcreated}
        <a id="ticket-number" href="viewticket.php?tid={$tid}&amp;c={$c}" class="alert-link">#{$tid}</a>
      </strong>
    </div>

    <div class="section">
      <div class="section-header">
        <p class="section-description">{$LANG.supportticketsticketcreateddesc}</p>
      </div>
      <div class="section-body">
        <a href="viewticket.php?tid={$tid}&amp;c={$c}" class="btn btn-default">
          {$LANG.continue}
          <i class="fad fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>
</div>