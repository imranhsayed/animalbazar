<div class="panel panel-default">
          <!-- Heading -->
          <div class="panel-heading" role="tab" id="headingEight">
             <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                <i class="more-less glyphicon glyphicon-plus"></i>
                <?php echo esc_html( $instance['title'] ); ?>
                </a>
             </h4>
          </div>
          <!-- Content -->
          <form method="get" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>" >
          <div id="collapseEight" class="panel-collapse collapse <?php echo esc_attr( $expand ); ?>" role="tabpanel" aria-labelledby="headingEight">
             <div class="panel-body">
                <div class="skin-minimal">
                   <ul class="list">
                   <?php
				   		$conditions	=	adforest_get_cats('ad_warranty' , 0 );
						foreach( $conditions as $con )
						{
				   ?>
                      <li>
                         <input tabindex="7" type="radio" id="minimal-radio-<?php echo esc_attr( $con->term_id); ?>" name="warranty" value="<?php echo esc_attr( $con->name); ?>" <?php if( $cur_war == $con->name ) {  echo esc_attr("checked"); } ?>  >
                         <label for="minimal-radio-<?php echo esc_attr( $con->term_id); ?>" ><?php echo esc_html($con->name); ?></label>
                      </li>
                      <?php
						}
					  ?>
                    </ul>
                </div>
             </div>
          </div>
			<?php
				echo adforest_search_params( 'warranty' );
            ?>
          </form>
       </div>