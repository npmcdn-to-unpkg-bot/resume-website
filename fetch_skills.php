<?php
$mastrianni_mysql_connection = new mysqli('localhost', 'USERNAME', 'PASSWORD', 'DATABASE'); //REAL CREDENTIALS EXCLUDED
$mastrianni_query = "SELECT id, skill_title, skill_svg_url, skill_level FROM skills_table ORDER BY RAND()"; //no user input, not sanitizing.
$mastrianni_rows = $mastrianni_mysql_connection->query($mastrianni_query);
//Columns Returned: id, skill_title, skill_svg_url, skill_level
?>
<!-- SKILLS BLOCK -->
<!-- This block is loaded via AJAX and appended after the dom loads. This allows the page to render before the HTTP requests for the SVG images complete. -->
<?php if(isset($mastrianni_rows)): ?>
<div class="row text-center mastrianni_skillset_heading">
    <div class="columns small-12">
        <h6>FILTER MY SKILLS BY EXPERIENCE LEVEL</h6>
        <div class="button-group filter-button-group stacked-for-small">
          <a class="button hvr-shutter-out-vertical" data-filter=".novice">NOVICE</a>
          <a class="button hvr-shutter-out-vertical" data-filter=".intermediate">INTERMEDIATE</a>
          <a class="button hvr-shutter-out-vertical" data-filter=".advanced">ADVANCED</a>
          <a class="button hvr-shutter-out-vertical current" data-filter="*">VIEW ALL</a>
        </div>
    </div>
</div>
<div class="row mastrianni_skillset mastrianni-iso-grid">
    <?php
        $mastrianni_img_url_prepend = "http://mastrianni.me/img/skills/";
        $mastrianni_num_rows = $mastrianni_rows->num_rows;
        $mastrianni_counter = 0;
    ?>
    <?php while($mastrianni_array = $mastrianni_rows->fetch_assoc()): ?>
        <?php $mastrianni_counter++; ?>
        <div class="columns small-4 medium-3 large-1 xlarge-1 <?php if($mastrianni_counter == $mastrianni_num_rows):echo "end";endif; ?> mastrianni-iso-grid-item <?php echo $mastrianni_array['skill_level']; ?>">
            <span data-tooltip class="has-tip top" aria-haspopup="true" data-disable-hover="false" title="<?php echo $mastrianni_array['skill_title']; ?>">
                <img src="<?php echo $mastrianni_img_url_prepend.$mastrianni_array['skill_svg_url']; ?>"
                     alt="<?php echo $mastrianni_array['skill_title']; ?>"
                     class="hvr-grow"
                >
            </span>
        </div>
    <?php endwhile; ?>
</div>
<?php endif; ?>