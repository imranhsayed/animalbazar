<?php
global $adforest_theme; 
$pid	=	get_the_ID();
$posttags = get_the_terms( get_the_ID(), 'ad_tags');

if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && $posttags )
	echo '<hr />';
?>
<div class="tags-share clearfix">
                     <div class="tags pull-left">
                        <?php 
                            $count=0;
                            $tags	=	'';
                            
                          if ($posttags)
                          {
                          ?>
                          <i class="fa fa-tags"></i>
                          	<ul>
                            
							<?php
								foreach($posttags as $tag)
								{
							?>
                            		<li>
                                    <a href="<?php echo esc_url( get_term_link($tag->term_id, 'ad_tags') ); ?>" title="<?php echo esc_attr( $tag->name ); ?>">
                                    #<?php echo esc_attr( $tag->name ); ?>
                                    </a>
                                    </li>
							<?php
								}
							?>
                          	</ul>
                       <?php
						  }
						?>
                     </div>
                  </div>