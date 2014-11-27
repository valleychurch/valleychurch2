<?php
/*
  Template Name: valley-update 
*/

require_once(get_template_directory() . '/ValleyUpdate.php');

get_header(); 
?>
<section class="container container--post">
    <article>
            <div class="content content--wide">
        <h1>Valley Update</h1>
        <p>Watch this week&#8217;s Valley Update to find out what&#8217;s going on in the life of church!</p>
<?php

$valleyupdate=new ValleyUpdate;
try
{
   $video_id=$valleyupdate->getValleyUpdateId();
   echo '<p><iframe src="//www.youtube.com/embed/' . $video_id . '?rel=0" width="560" height="315" frameborder="0" ' .
         'allowfullscreen="allowfullscreen"></iframe></p>';
}
catch (Exception $e)
{
   echo "<p>Valley Update Video not on youtube</p>";
}
?>
      </div>
    </article>
  </section>

<?php
get_footer();
?>
