<footer>
  <?php 
  $startYear = 2020;
  $thisYear = date('Y');
  if ($startYear == $thisYear) {
    $copyright = $thisYear;
  } else {
    $copyright = $startYear . ' &ndash; ' . $thisYear;
  }
  if ($data['title'] == 'About') { ?>
    <p>Art is the conscious creation of something beautiful or meaningful using skill and imagination</p>
  <?php } ?>
    <details>
      <summary>Copyright&nbsp;&nbsp;<?= $copyright ?>&nbsp;&nbsp;by&nbsp;&nbsp;d a: n j ə l s</summary>
      <p>All content and graphics on this web site are the property of Wim Dani&euml;ls.</p>
    </details>
  </footer>
</main>