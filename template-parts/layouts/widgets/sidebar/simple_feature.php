<div class="panel panel-default">
          <!-- Heading -->
          <div class="panel-heading" role="tab" id="headingNine">
             <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                <i class="more-less glyphicon glyphicon-plus"></i>
                <?php echo esc_html( $instance['title'] ); ?>
                </a>
             </h4>
          </div>
          <!-- Content -->
          <form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>" >
          <div id="collapseNine" class="panel-collapse collapse <?php echo esc_attr( $expand ); ?>" role="tabpanel" aria-labelledby="headingNine">
             <div class="panel-body">
                <div class="skin-minimal">
                   <ul class="list">
                      <li>
                         <input tabindex="7" type="radio" id="minimal-radio-sb_1" name="ad" value="0" <?php echo esc_attr( $simple ); ?>  >
                         <label for="minimal-radio-sb_1" >
						 <?php echo __('Simple Ads','adforest'); ?></label>
                      </li>
                      <li>
                         <input tabindex="7" type="radio" id="minimal-radio-sb_2" name="ad" value="1" <?php echo esc_attr( $featured ); ?>  >
                         <label for="minimal-radio-sb_2" >
						 <?php echo __('Featured Ads','adforest'); ?></label>
                      </li>
                    </ul>
                </div>
             </div>
          </div>
			<?php
				echo adforest_search_params( 'ad' );
            ?>
          </form>
</div>