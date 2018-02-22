<?php
/*
 	Basic functions.
*/


/** * close all open xhtml tags at the end of the string

 * * @param string $html

 * @return string
 */
 if ( ! function_exists( 'adforest_close_tags' ) ) {
 function adforest_close_tags($html)
 {
	  preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
	  $openedtags = $result[1];   #put all closed tags into an array
	  preg_match_all('#</([a-z]+)>#iU', $html, $result);
	  $closedtags = $result[1];
	  $len_opened = count($openedtags);
	
	  if (count($closedtags) == $len_opened) {
	
		return $html;
	
	  }
	  $openedtags = array_reverse($openedtags);
	  for ($i=0; $i < $len_opened; $i++) {
	
		if (!in_array($openedtags[$i], $closedtags)){
	
		  $html .= '</'.$openedtags[$i].'>';
	
		} else {
	
		  unset($closedtags[array_search($openedtags[$i], $closedtags)]);    }
	
	  }  
	  return $html;
} 
 }

/* ------------------------------------------------ */
/* Comments */
/* ------------------------------------------------ */

if ( ! function_exists( 'adforest_comments_list' ) ) :
function adforest_comments_list( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$img = '';
	if( get_avatar_url( $comment, 44 ) != "" ) 
	{
		$img = '<img class="pull-left hidden-xs img-circle" alt="'.esc_attr__('Avatar', 'adforest' ).'" src="'.esc_url( get_avatar_url( $comment, 44 ) ).'" />';
	}
?>

<li class="comment" id="comment-<?php esc_attr( comment_ID() ); ?>">
    <div class="comment-info">
    <?php echo "" . $img; ?>
    <div class="author-desc">
     <div class="author-title">
        <strong><?php comment_author(); ?></strong>
        <ul class="list-inline pull-right">
           <li><a href="javascript:void(0);"><?php echo esc_html( get_comment_date( )) .  " "  . esc_html( get_comment_time() ); ?></a>
           </li>
<?php 
$myclass = ' active-color';
$reply_link	=	 preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $myclass, 
get_comment_reply_link( array_merge( $args, array( 'reply_text' => esc_attr__( 'Reply', 'adforest'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ), 1 );
?>
<?php 
if( $reply_link != "" )
{
?>
           <li><?php echo wp_kses( $reply_link, adforest_required_tags() ); ?>
<?php
}
?>
           </li>
        </ul>
     </div>
     <?php comment_text(); ?>
    </div>
    </div>
<?php if( $args['has_children'] == "" )
   { echo '</li>'; }?>
<?php	
}
endif;
/* ------------------------------------------------ */
/* Pagination */
/* ------------------------------------------------ */
if ( ! function_exists( 'adforest_pagination' ) ) {
function adforest_pagination() {
		if( is_singular() )
			return;
	
		global $wp_query;
		/** Stop execution if there's only 1 page */
		if( $wp_query->max_num_pages <= 1 )
			return;
	
			$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
			$max   = intval( $wp_query->max_num_pages );
	
			/**	Add current page to the array */
			if ( $paged >= 1 )
				$links[] = $paged;
		
			/**	Add the pages around the current page to the array */
			if ( $paged >= 3 ) {
				$links[] = $paged - 1;
				$links[] = $paged - 2;
			}
		
			if ( ( $paged + 2 ) <= $max ) {
				$links[] = $paged + 2;
				$links[] = $paged + 1;
			}
		
			echo '<ul class="pagination pagination-large">' . "\n";
		
			if ( get_previous_posts_link() )
				printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
			
			/**	Link to first page, plus ellipses if necessary */
			if ( ! in_array( 1, $links ) ) {
				$class = 1 == $paged ? ' class="active"' : '';
		
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
	
			if ( ! in_array( 2, $links ) )
				echo '<li><a href="javascript:void(0);">...</a></li>';
		}
	
		/**	Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) 
		{
			$class = $paged == $link ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}
	
		/**	Link to last page, plus ellipses if necessary */
		if ( ! in_array( $max, $links ) ) 
		{
			if ( ! in_array( $max - 1, $links ) )
				echo '<li><a href="javascript:void(0);">...</a></li>' . "\n";
			$class = $paged == $max ? ' class="active"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}
	
		if ( get_next_posts_link() )
			printf( '<li>%s</li>' . "\n", get_next_posts_link() );
		echo '</ul>' . "\n";
	
	}
}

if ( ! function_exists( 'adforest_pagination_search' ) ) {
function adforest_pagination_search($wp_query) {
	if( is_singular() )
		//return;

	//global $wp_query;
	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

		//$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		$max   = intval( $wp_query->max_num_pages );

		/**	Add current page to the array */
		if ( $paged >= 1 )
			$links[] = $paged;
	
		/**	Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}
	
		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}
	
		echo '<ul class="pagination pagination-lg">' . "\n";
	
		if ( get_previous_posts_link() )
			printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
		
		/**	Link to first page, plus ellipses if necessary */
		if ( ! in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="active"' : '';
	
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li><a href="javascript:void(0);">...</a></li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) 
	{
		
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) 
	{
		if ( ! in_array( $max - 1, $links ) )
			echo '<li><a href="javascript:void(0);">...</a></li>' . "\n";
		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	
	
	if ( get_next_posts_link_custom($wp_query) )
		printf( '<li>%s</li>' . "\n", get_next_posts_link_custom($wp_query) );
	
	echo '</ul>' . "\n";

}
}

if ( ! function_exists( 'get_next_posts_link_custom' ) ) {
function get_next_posts_link_custom( $wp_query, $label = null, $max_page = 0 ) {
    global $paged;
	
 
    if ( !$max_page )
        $max_page = $wp_query->max_num_pages;
 
    if ( !$paged )
        $paged = 1;
 
    $nextpage = intval($paged) + 1;
 
    if ( null === $label )
        $label = __( 'Next Page &raquo;', 'adforest' );
 
    if ( $nextpage <= $max_page  ) {
        /**
         * Filters the anchor tag attributes for the next posts page link.
         *
         * @since 2.7.0
         *
         * @param string $attributes Attributes for the anchor tag.
         */
        $attr = apply_filters( 'next_posts_link_attributes', '' );
 
        return '<a href="' . next_posts( $max_page, false ) . "\" $attr>" . preg_replace('/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', $label) . '</a>';
    }
}
}
// Return Category ID
if ( ! function_exists( 'adforest_getCatID' ) ) {
function adforest_getCatID()
{
	return esc_html( get_cat_id( single_cat_title("",false) ) ); 
}
}


// Breadcrumb
if ( ! function_exists( 'adforest_breadcrumb' ) ) {
function adforest_breadcrumb() {
			$string = '';

			if (is_category() ) 
			{
				$string .=  esc_html( get_cat_name( adforest_getCatID( ) ) );
			}
			else if (is_single()) 
			{
				$string .=  esc_html( get_the_title() );
			}
			elseif (is_page())
			{
				$string .=   esc_html( get_the_title() );
			}
			elseif (is_tag())
			{
				$string .=    esc_html( single_tag_title( "", false ) );
			}
			elseif (is_search()) 
			{
				$string .=  esc_html( get_search_query() );	 
			}
			elseif (is_404()) 
			{
				$string .=  esc_html__('Page not Found', 'adforest' ); 
			}
			elseif (is_author()) 
			{
				$string .=  __('Author', 'adforest' ); 
			}
			else if( is_tax() )
			{
				$string	.=  esc_html( single_cat_title( "", false ) ); 
			}
			elseif (is_archive()) 
			{
				$string .=  esc_html__('Archive', 'adforest' ); 
			}
			else if( is_home() )
			{
				$string	=	 esc_html__( 'Latest Stories', 'adforest' );	
			}
	return $string;
}
}

// Get BreadCrumb Heading
if ( ! function_exists( 'adforest_bread_crumb_heading' ) ) {
function adforest_bread_crumb_heading()
{
		$page_heading	=	'';
		global $adforest_theme;
	if( is_search() )
	{
		$string	=	esc_html__( 'entire web', 'adforest' );
		if( get_search_query() != "" )
		{
			$string	=	get_search_query();	
		}
		$page_heading	=	sprintf( esc_html__( 'Search Results for: %s', 'adforest' ), esc_html( $string ) );	
	}
	else if( is_category() )
	{
		$page_heading	=	esc_html( single_cat_title( "", false ) ); 
		
	}
	else if( is_tag() )
	{
		$page_heading	=	 esc_html__( 'Tag: ', 'adforest' ) .  esc_html( single_tag_title( "", false ) ) ;
	}
	else if( is_404() )
	{
		$page_heading	=		esc_html__( 'Page not found', 'adforest' );
	}
	else if( is_author() )
	{
		$author_id = get_query_var( 'author' );
		$author = get_user_by( 'ID', $author_id );
		$page_heading	=  $author->display_name; 

	}
	else if( is_tax() )
	{
		$page_heading	=  esc_html( single_cat_title( "", false ) ); 
	}
	else if( is_archive() )
	{
		$page_heading	=	__('Blog Archive', 'adforest');
	}
	else if( is_home() )
	{
		$page_heading	=	 esc_html__( 'Latest Stories', 'adforest' );	
	}
	else if( is_singular( 'post' ) )
	{
		if( isset( $adforest_theme['sb_blog_single_title'] ) && $adforest_theme['sb_blog_single_title'] != "" )
		{
			$page_heading	=	$adforest_theme['sb_blog_single_title'];	
		}
		else
		{
			$page_heading	=	__('Blog Detail', 'adforest');
		}
	}
	else if( is_singular( 'page' ) )
	{
		$page_heading	=	get_the_title();	
	}
	else if( is_singular( 'ad_post' ) )
	{
		if( isset( $adforest_theme['sb_single_ad_text'] ) && $adforest_theme['sb_single_ad_text'] != "" )
			$page_heading	=	$adforest_theme['sb_single_ad_text'];	
		else
			$page_heading	=	__('Ad Detail', 'adforest');
	}
	
	return $page_heading;	
}
}

// ------------------------------------------------ //
// Get and Set Post Views //
// ------------------------------------------------ //
if ( ! function_exists( 'adforest_getPostViews' ) ) {
 function adforest_getPostViews($postID){
	 $postID	=	esc_html( $postID );
  $count_key = 'sb_post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count==''){
   delete_post_meta($postID, $count_key);
   add_post_meta($postID, $count_key, '0');
   return "0";
  }
  return $count;
 }
}
 
if ( ! function_exists( 'adforest_setPostViews' ) ) {
function adforest_setPostViews($postID) {
$postID 	=	esc_html( $postID );
$count_key = 'sb_post_views_count';
$count = get_post_meta($postID, $count_key, true);
if($count==''){
$count = 0;
delete_post_meta($postID, $count_key);
add_post_meta($postID, $count_key, '0');
}else{
$count++;
update_post_meta($postID, $count_key, $count);
}
}
}
 
// get post description as per need. 
if ( ! function_exists( 'adforest_words_count' ) ) {
function adforest_words_count($contect = '', $limit = 180)
{
	 $string	=	'';
	 $contents = strip_tags( strip_shortcodes( $contect ) );
	 $contents	=	adforest_removeURL( $contents );
	 $removeSpaces = str_replace(" ", "", $contents);
	 $contents	=	preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $contents);
	 if(strlen($removeSpaces) > $limit)
	 {
	 	 return substr(str_replace("&nbsp;","",$contents), 0, $limit).'...';
	 }
	 else
	 {
	 	 return str_replace("&nbsp;","",$contents);
	 }
}
}

if ( ! function_exists( 'adforest_social_share' ) ) {
function adforest_social_share() {
	
		// check if plugin addtoany actiavted then load that otherwise builtin function
		if ( in_array( 'add-to-any/add-to-any.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
		{
			return do_shortcode('[addtoany]');
		}
		
	
		// Get current page URL 
		$sbURL = esc_url( get_permalink() );
 
		// Get current page title
		$sbTitle = str_replace( ' ', '%20', esc_html( get_the_title() ));

		// Get Post Thumbnail for pinterest
		$sbThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( esc_html( get_the_ID() ) ), 'sb-single-blog-featured' );
 
		// Construct sharing URL without using any script
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$sbTitle.'&amp;url='.$sbURL;
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$sbURL;
		$googleURL = 'https://plus.google.com/share?url='.$sbURL;
		$bufferURL = 'https://bufferapp.com/add?url='.$sbURL.'&amp;text='.$sbTitle;
		
		// Based on popular demand added Pinterest too
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$sbURL.'&amp;media='.$sbThumbnail[0].'&amp;description='.$sbTitle;
 
		// Add sharing button at the end of page/page content
		
        return '<a href="'.esc_url( $facebookURL ).'" class="btn btn-fb btn-md" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="'.esc_url( $twitterURL ).'" class="btn btn-twitter btn-md" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="'.esc_url( $googleURL ).'" class="btn btn-gplus btn-md" target="_blank"><i class="fa fa-google-plus"></i></a>
				';

}
}

if ( ! function_exists( 'adforest_required_attributes' ) ) {
function adforest_required_attributes()
{
	return $default_attribs = array(
		'id' => array(),
		'src' => array(),
		'href' => array(),
		'target' => array(),
		'class' => array(),
		'title' => array(),
		'type' => array(),
		'style' => array(),
		'data' => array(),
		'role' => array(),
		'aria-haspopup' => array(),
		'aria-expanded' => array(),
		'data-toggle' => array(),
		'data-hover' => array(),
		'data-animations' => array(),
		'data-mce-id' => array(),
		'data-mce-style' => array(),
		'data-mce-bogus' => array(),
		'data-href' => array(),
		'data-tabs' => array(),
		'data-small-header' => array(),
		'data-adapt-container-width' => array(),
		'data-height' => array(),
		'data-hide-cover' => array(),
		'data-show-facepile' => array(),
	);
}
}

if ( ! function_exists( 'adforest_required_tags' ) ) {
function adforest_required_tags()
{
        return $allowed_tags = array(
            'div'           => adforest_required_attributes(),
            'span'          => adforest_required_attributes(),
            'p'             => adforest_required_attributes(),
            'a'             => array_merge( adforest_required_attributes(), array(
                'href' => array(),
                'target' => array('_blank', '_top'),
            ) ),
            'u'             =>  adforest_required_attributes(),
            'br'             =>  adforest_required_attributes(),
            'i'             =>  adforest_required_attributes(),
            'q'             =>  adforest_required_attributes(),
            'b'             =>  adforest_required_attributes(),
            'ul'            => adforest_required_attributes(),
            'ol'            => adforest_required_attributes(),
            'li'            => adforest_required_attributes(),
            'br'            => adforest_required_attributes(),
            'hr'            => adforest_required_attributes(),
            'strong'        => adforest_required_attributes(),
            'blockquote'    => adforest_required_attributes(),
            'del'           => adforest_required_attributes(),
            'strike'        => adforest_required_attributes(),
            'em'            => adforest_required_attributes(),
            'code'          => adforest_required_attributes(),
            'style'          => adforest_required_attributes(),
            'script'          => adforest_required_attributes(),
            'img'          => adforest_required_attributes(),
        );
}
}
 
 
// pages links
paginate_comments_links();
the_post_thumbnail();

// get feature image
if ( ! function_exists( 'adforest_get_feature_image' ) ) {
function adforest_get_feature_image($post_id, $image_size )
{
	return wp_get_attachment_image_src( get_post_thumbnail_id( esc_html( $post_id ) ), $image_size );	
}
}

 /* Add Next Page Button in First Row */
add_filter( 'mce_buttons', 'adforest_my_next_page_button', 1, 2 ); // 1st row
 
/**
 * Add Next Page/Page Break Button
 * in WordPress Visual Editor
 */
if ( ! function_exists( 'adforest_my_next_page_button' ) ) {
function adforest_my_next_page_button( $buttons, $id ){
 
    /* only add this for content editor */
    if ( 'content' != $id )
        return $buttons;
 
    /* add next page after more tag button */
    array_splice( $buttons, 13, 0, 'wp_page' );
 
    return $buttons;
}
}


// search only within posts.
if ( ! function_exists( 'adforest_search_filter' ) ) {
function adforest_search_filter( $query ) {
	
		if ($query->is_author)
		{
			$query->set( 'post_type', array('ad_post') );
		}
		
		return $query;
}
}

if ( ! is_admin() && isset( $_GET['type'] ) && $_GET['type'] == 'ads' )
{
		add_filter('pre_get_posts','adforest_search_filter');
}

// get post format icon
if ( ! function_exists( 'adforest_post_format_icon' ) ) {
function adforest_post_format_icon( $format = '' )
{
	if( $format == "" )
	{
		return 'ion-ios-star';	
	}
	$format_icons	=	array( 'audio' => 'ion-volume-medium', 'video' => 'ion-videocamera', 'image' => 'ion-images', 'quote' => 'ion-quote' );
	return $format_icons[$format];
}
}

// get current page url
if ( ! function_exists( 'adforest_get_current_url' ) ) {
function adforest_get_current_url()
{
	return $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";	
}
}


// return numbers array
if ( ! function_exists( 'adforest_addNumbers' ) ) {
function adforest_addNumbers($r = 20)
{
    $numArr = '';
    for ($i = 1; $i <= $r; $i++) {
        $numArr[$i] = $i;
    }
    return $numArr;
}
}

// check post format if exist
if ( ! function_exists( 'adforest_post_format_exist' ) ) {
function adforest_post_format_exist($format = '')
{
		$formats	=	array( '', 'image', 'audio', 'video', 'quote' );
		if ( in_array( $format, $formats ) )
		{
			return true;
		}
		else
		{
			return false;	
		}
}
}

if ( ! function_exists( 'adforest_get_cats' ) ) {
function adforest_get_cats($taxonomy = 'category', $parent_of = 0, $child_of = 0 )
{
$defaults = array(
        'taxonomy'               => $taxonomy,
        'orderby'                => 'name',
        'order'                  => 'ASC',
        'hide_empty'             => 0,
        'exclude'                => array(),
        'exclude_tree'           => array(),
        'number'                 => '',
        'offset'                 => '',
        'fields'                 => 'all',
        'name'                   => '',
        'slug'                   => '',
        'hierarchical'           => true,
        'search'                 => '',
        'name__like'             => '',
        'description__like'      => '',
        'pad_counts'             => false,
        'get'                    => '',
        'child_of'               => $child_of,
        'parent'                 => $parent_of,
        'childless'              => false,
        'cache_domain'           => 'core',
        'update_term_meta_cache' => true,
        'meta_query'             => ''
    );
	
	return get_terms( $defaults );
 }
}
 
 // Modifying search form
add_filter('get_search_form', 'adforest_search_form');
if ( ! function_exists( 'adforest_search_form' ) ) {
function adforest_search_form($text)
{
    
 $text = str_replace('<label>', '<div class="search-blog"><div class="input-group stylish-input-group">', $text);
    $text = str_replace('</label>', '<span class="input-group-addon">
                        <button type="submit"> <span class="fa fa-search"></span> </button>
                                            </span></div></div>', $text);
    $text = str_replace('<span class="screen-reader-text">Search for:</span>', '', $text);
    $text = str_replace('class="search-field"', 'class="form-control" id="serch"', $text);
    return $text;	
}
}

// remove url from excerpt
if ( ! function_exists( 'adforest_removeURL' ) ) {
function adforest_removeURL($string)
{
  return preg_replace("/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i", '', $string);
}
}

// Get param value of VC
if ( ! function_exists( 'adforest_get_param_vc' ) ) {
function adforest_get_param_vc($break, $string)
{
	$arr = explode($break, $string);
	$res	=	explode(' ', $arr[1] );
	$r	=	 explode('"', $res[0] );
	return $r[1];
}
}
/*
 * Hook in on activation
 *
 */
 if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	add_action( 'init', 'adforest_woocommerce_image_dimensions', 1 );
 }
/**
 * Define image sizes
 */
if ( ! function_exists( 'adforest_woocommerce_image_dimensions' ) ) {
function adforest_woocommerce_image_dimensions() {
	$catalog = array(
		'width' 	=> '358',	// px
		'height'	=> '269',	// px
		'crop'		=> 1,
	);

	$single = array(
		'width' 	=> '396',	// px
		'height'	=> '302',	// px
		'crop'		=> 1,
	);

	$thumbnail = array(
		'width' 	=> '100',	// px
		'height'	=> '100',	// px
		'crop'		=> 1,
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}
}

// getting social icon array
if ( ! function_exists( 'adforest_social_icons' ) ) {
function adforest_social_icons( $social_network )
{
	$social_icons	=	 array(
		 'Facebook' => 'fa fa-facebook',
		 'Twitter' => 'fa fa-twitter ',
		 'Linkedin' => 'fa fa-linkedin ',
		 'Google' => 'fa fa-google-plus',
		 'YouTube' => 'fa fa-youtube-play',
		 'Vimeo' => 'fa fa-vimeo ',
		 'Pinterest' => 'fa fa-pinterest ',
		 'Tumblr' => 'fa fa-tumblr ',
		 'Instagram' => 'fa fa-instagram',
		 'Reddit' => 'fa fa-reddit ',
		 'Flickr' => 'fa fa-flickr ',
		 'StumbleUpon' => 'fa fa-stumbleupon',
		 'Delicious' => 'fa fa-delicious ',
		 'dribble' => 'fa fa-dribbble ',
		 'behance' => 'fa fa-behance',
		 'DeviantART' => 'fa fa-deviantart',
		);
	return $social_icons[ $social_network ];
}
}

add_filter('wp_list_categories', 'opportunies_cat_count_span');
if ( ! function_exists( 'opportunies_cat_count_span' ) ) {
function opportunies_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span class="pull-right">(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}
}

if ( ! function_exists( 'adforest_sample_admin_notice_activate' ) ) {
function adforest_sample_admin_notice_activate() {
	if( get_option( '_sb_purchase_code' ) != "" )
	{
		return;	
	}
	?>
	<div class="notice notice-error is-dismissible">
		<h4><?php echo __( 'Attention!', 'adforest' ); ?></h4>
		<p><?php echo __('Please Verify your PURCHASE code in order to work this theme.', 'adforest' ); ?></p>
		<p>
			<?php echo __( 'Purchase Code:', 'adforest' ); ?>
			<input type="text" name="adforest_code" id="adforest_code" size="50" />
			<input type="button" id="verify_it" value="Verify"/>
		</p>
	</div>
	<?php
}
}
add_action( 'admin_notices', 'adforest_sample_admin_notice_activate' );

add_action( 'wp_ajax_verify_code', 'adforest_verify_code' );
if ( ! function_exists( 'adforest_verify_code' ) ) {
function adforest_verify_code()
{
	$code	=	$_POST['code'];
	$my_theme = wp_get_theme();
	$theme_name	=	$my_theme->get( 'Name' );
	$data	=	"?purchase_code=" . $code . "&id=" . get_option( 'admin_email' ) . '&url=' . get_option( 'siteurl' ) .'&theme_name=' . $theme_name;
	$url	=	esc_url( "http://authenticate.scriptsbundle.com/adforest/verify_code.php" ) . $data;
	$response = wp_remote_get($url);
	$res	=	$response['body'];
	if( $res == 'verified' )
	{
		update_option( '_sb_purchase_code', $code );
		echo('Looks good, now you can install required plugins.');	
	}
	else
	{
		echo('Invalid valid purchase code.');	
	}
	die();
}
}

if ( ! function_exists( 'adforest_make_link' ) ) {
function adforest_make_link( $url, $text )
{
	return wp_kses( "<a href='". esc_url ( $url )."' target='_blank'>", adforest_required_tags() )  . $text . wp_kses( '</a>', adforest_required_tags() );	
}
}

// Translation
if ( ! function_exists( 'adforest_translate' ) ) {
function adforest_translate( $index )
{
	$strings 	=	 array( 
		'variation_not_available' => __( 'This product is currently out of stock and unavailable.', 'adforest' ), 	
		'adding_to_cart' => __('Adding...', 'adforest' ),
		'add_to_cart' => __('add to cart', 'adforest' ),
		'view_cart' => __('View Cart', 'adforest' ),
		'cart_success_msg' => __('Product Added successfully.', 'adforest' ),
		'cart_success' => __('Success', 'adforest' ),
		'cart_error_msg' => __('Something went wrong, please try it again.', 'adforest' ),
		'cart_error' => __('Error', 'adforest' ), 
		'email_error_msg' => __('Please add valid email.', 'adforest' ),
		'mc_success_msg' => __('Thank you, we will get back to you.', 'adforest' ),
		'mc_error_msg' => __('There is some error, please check your API-KEY and LIST-ID.', 'adforest' ),
	);
	
	
	return $strings[$index];	
}
}

if ( ! function_exists( 'adforest_get_comments' ) ) {
function adforest_get_comments()
{
	echo get_comments_number() . " " .  __( 'comments', 'adforest' );	
}
}


if ( ! function_exists( 'adforest_get_date' ) ) {
function adforest_get_date( $PID )
{
	echo get_the_date( get_option( 'date_format' ), $PID );
}
}


if(isset($_GET['post_status']) && $_GET['post_status']=='trash' && $_GET['post_type']=='_sb_country'){
     add_action( 'admin_notices', 'adforest_notice_for_delete_country' );
}

if ( ! function_exists( 'adforest_notice_for_delete_country' ) ) {
function adforest_notice_for_delete_country()
{
	?>
	<div class="notice notice-info">
        <strong><p><?php echo __('If you delete country permanently then all associated states and cities will be deleted with it.', 'adforest' ); ?></p></strong>
    </div>	
    <?php
}
}


if( isset( $_GET['post_type'] )  )
{
	if( $_GET['post_type'] == '_sb_country' )
	{
     	add_action( 'admin_notices', 'adforest_notice_for_add_country' );
	}	
}


if ( ! function_exists( 'adforest_notice_for_add_country' ) ) {
function adforest_notice_for_add_country()
{
	?>
	<div class="notice notice-info">
        <p><?php echo __('Must need to aad country NAME as google list like United Arab Emirates, check it', 'adforest' ); ?>
        <a href="https://developers.google.com/public-data/docs/canonical/countries_csv" target="_blank">
        <strong><?php echo __('HERE', 'adforest' ); ?></strong>
        </a>
        </p>
    </div>	
    <?php
}
}


if ( ! function_exists( 'adforest_redirect' ) ) {
function adforest_redirect( $url = '' )
{ 
	return '<script>window.location = "' . $url .  '";</script>';		
}
}

add_action('init', 'adforest_StartSession', 1);
if ( ! function_exists( 'adforest_StartSession' ) ) {
function adforest_StartSession() {
    if(!session_id()) {
        session_start();
    }
}
}

// Bad word filter
if ( ! function_exists( 'adforest_badwords_filter' ) ) {
function adforest_badwords_filter( $words = array(), $string, $replacement )
{
	foreach( $words as $word )
	{
		$string	=	str_replace($word, $replacement, $string);
	}
	return $string;
}
}

// Post statuses
if ( ! function_exists( 'adforest_ad_statues' ) ) {
function adforest_ad_statues( $index )
{
	if( $index == "" )
		$index = 'active';
	$sb_status	=	array( 'active' => __('Active','adforest' ), 'expired' => __('Expired','adforest' ), 'sold' => __('Sold','adforest' ) );
	return $sb_status[$index];	
}
}

// Time Ago
if ( ! function_exists( 'adforest_timeago' ) ) {
function adforest_timeago($date) {
	   $timestamp = strtotime($date);	
	   
	   $strTime = array(__('second','adforest'), __('minute','adforest'),__('hour','adforest'),__('day','adforest'),__('month','adforest'),__('year','adforest') );
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . __('(s) ago','adforest' );
	   }
	}
}

// Redirect
if ( ! function_exists( 'adforest_redirect_with_msg' ) ) {
function adforest_redirect_with_msg( $url, $msg = '' )
{

	echo '
	<script type="text/javascript" src="'.trailingslashit( get_template_directory_uri () ) . 'js/toastr.min.js"></script>
	<script type="text/javascript">
			toastr.error("'.$msg.'", "", {timeOut: 2500,"closeButton": true, "positionClass": "toast-top-right"});
			window.location	=	"'.$url.'";
		</script>';
		exit;
}
}

// Time difference n days
if ( ! function_exists( 'adforest_days_diff' ) ) {
function adforest_days_diff( $now, $from )
{
	$datediff = $now - $from;

	return floor($datediff / (60 * 60 * 24));	
}
}

// Color of Ads
if ( ! function_exists( 'adforest_ads_status_color' ) ) {
function adforest_ads_status_color( $status )
{
	if( $status == "" )
	{
		return;
	}
	$colors	=array( 'active' => 'status_active', 'expired' => 'status_expired', 'sold' => 'status_sold' );
	return $colors[$status];
}
}

// adforest search params
if ( ! function_exists( 'adforest_search_params' ) ) {
function adforest_search_params( $index, $second = '', $third = '', $search_url = false)
{
	global $adforest_theme;
	$param	=	$_SERVER['QUERY_STRING'];
	$res	=	'';
	if( isset( $param ) && $index != 'cat_id' )
	{
		parse_str($_SERVER['QUERY_STRING'], $vars);
		foreach( $vars as $key => $val )
		{
			
			if ( $key == $index )
				continue;
				
			if($second != "" )
			{
				if ( $key == $second )
					continue;	
			}
			if($third != "" )
			{
				if ( $key == $third )
					continue;	
			}

			if(isset($vars['custom']) && count($vars['custom']) > 0 && 'custom' == $key)
			
			{
				foreach($vars['custom'] as $ckey => $cval )
				{
					$name = "custom[$ckey]";
					if ( $name == $index ) {continue;}
					$res .= '<input type="hidden" name="'.esc_attr($name).'" value="'. esc_attr( $cval ) .'" />';
					
				}
			}
			else{
			
		  	$res .= '<input type="hidden" name="'.esc_attr( $key ). '" value="'. esc_attr( $val ) .'" />';
			}
		}
	}
	else if( $search_url )
	{
		$res	= get_the_permalink( $adforest_theme['sb_search_page'] );	
	}
	return $res;
	
}
}



// Get parents of custom taxonomy
if ( ! function_exists( 'adforest_get_taxonomy_parents' ) ) {
function adforest_get_taxonomy_parents($id, $taxonomy, $link = true, $separator = ' &raquo; ', $nicename = false, $visited = array()) {

$chain = '';

$parent = get_term($id, $taxonomy);

if (is_wp_error($parent))
{ 
	echo "fail";
    return $parent;
}

if ($nicename)
{
    $name = $parent->slug;
}
else
{
    $name = $parent->name;
}

if ($parent -> parent && ($parent -> parent != $parent -> term_id) && !in_array($parent -> parent, $visited)) {

    $visited[] = $parent -> parent;

    $chain .= adforest_get_taxonomy_parents($parent->parent, $taxonomy, $link, $separator, $nicename, $visited);

}

    if ( $link ) {
        $chain .= '<a href="' . esc_url( get_term_link( (int) $parent->term_id, $taxonomy ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s", 'adforest' ), $parent->name ) ) . '">'.$name.'</a>' . $separator;
    } else {
        $chain .= $separator . $name;
    }
    return $chain;

}
}

if ( ! function_exists( 'adforest_display_cats' ) ) {
function adforest_display_cats( $pid )
{
			$post_categories = wp_get_object_terms( $pid,  array('ad_cats'), array('orderby' => 'term_group') );
			$cats_html	=	'';
		foreach($post_categories as $c)
		{
			$cat = get_term( $c );
			$cats_html	.= '<span class="padding_cats"><a href="'.get_term_link( $cat->term_id ).'">'.esc_html( $cat->name ).'</a></span>';
		}
		return $cats_html;
	
}
}

if ( ! function_exists( 'adforest_removeCPTCommentsFromWidget' ) ) {
function adforest_removeCPTCommentsFromWidget( $example ) {
    $ar = array('post_type' => 'post');
    return $ar;
}
}
add_filter( 'widget_comments_args', 'adforest_removeCPTCommentsFromWidget' );

//Allow Pending products to be viewed by listing/product owner
if ( ! function_exists( 'posts_for_current_author' ) ) {
function posts_for_current_author($query)
{
	if( isset( $_GET['post_type'] ) && $_GET['post_type'] == "ad_post"  && isset($_GET['p']) )
	{
		$post_id	= $_GET['p'];
		$post_author = get_post_field( 'post_author', $post_id );
		if ( is_user_logged_in() && get_current_user_id() == $post_author )
		{
			$query->set('post_status', array('publish','pending'));
			return $query;

		}
		else
		{
			return $query;	
		}
	}
	else
	{
		return $query;	
	}
}
}
add_filter('pre_get_posts', 'posts_for_current_author');

if ( ! function_exists( 'adforest_get_all_countries' ) ) {
function adforest_get_all_countries()
{
	$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'title',
	'order'            => 'ASC',
	'post_type'        => '_sb_country',
	'post_status'      => 'publish',
	);
	$countries = get_posts( $args );
	$res	=	array();
	foreach( $countries as $country )
	{
		$res[$country->post_excerpt] = $country->post_title;
	}
	return $res;
}
}

if ( ! function_exists( 'adforest_adPrice' ) ) {
function adforest_adPrice($id = '', $class = 'negotiable')
{
	if( get_post_meta($id, '_adforest_ad_price', true ) == "" && get_post_meta($id, '_adforest_ad_price_type', true ) == "on_call" )
	{
		return __("Price On Call", 'adforest');
	}
	if( get_post_meta($id, '_adforest_ad_price', true ) == "" && get_post_meta($id, '_adforest_ad_price_type', true ) == "free" )
	{
		return __("Free", 'adforest');
	}

	if( get_post_meta($id, '_adforest_ad_price', true ) == "" || get_post_meta($id, '_adforest_ad_price_type', true ) == "no_price" )
	{
		return '';	
	}
	
	$price  = 0;
	global $adforest_theme;
	$thousands_sep = ",";
	if( isset( $adforest_theme['sb_price_separator'] ) )
	{
		$thousands_sep = $adforest_theme['sb_price_separator'];
	}
	$decimals = 0;
	if( isset( $adforest_theme['sb_price_decimals'] ) )
	{
		$decimals = $adforest_theme['sb_price_decimals'];
	}
	$decimals_separator = ".";
	if( isset( $adforest_theme['sb_price_decimals_separator'] ) )
	{
		$decimals_separator = $adforest_theme['sb_price_decimals_separator'];
	}
	$curreny = $adforest_theme['sb_currency'];
	if( get_post_meta( $id, '_adforest_ad_currency', true ) != "" )
	{
		$curreny = get_post_meta( $id, '_adforest_ad_currency', true );
	}

	
	if($id != "")
	{
//		$price  = number_format( (int)get_post_meta($id, '_adforest_ad_price', true ), $decimals, $decimals_separator, $thousands_sep  );
		$price  = (int)get_post_meta($id, '_adforest_ad_price', true );
		$price  = ( isset( $price ) && $price != "") ? $price : 0;	
		
		if( isset($adforest_theme['sb_price_direction']) && $adforest_theme['sb_price_direction'] == 'right' )
		{
			$price = '₹ ' .$curreny . ' ';
		}	
		else if( isset($adforest_theme['sb_price_direction']) && $adforest_theme['sb_price_direction'] == 'left' )
		{
			$price = '₹ ' .$price . ' ';
		}	
		else
		{
			$price = '₹ ' . $price . ' ';
		}
		
	}
	// Price type fixed or ...
	$price_type_html = '';
	if( get_post_meta($id, '_adforest_ad_price_type', true ) != "" && isset( $adforest_theme['allow_price_type'] ) && $adforest_theme['allow_price_type'] )
	{
		$price_type = '';
		if( get_post_meta($id, '_adforest_ad_price_type', true ) == 'Fixed' )
		{
			$price_type	=	__(' Fixed ','adforest');
		}
		else if( get_post_meta($id, '_adforest_ad_price_type', true ) == 'Negotiable' )
		{
			$price_type	=	__(' Negotiable ','adforest');
		}
		else if( get_post_meta($id, '_adforest_ad_price_type', true ) == 'auction' )
		{
			$price_type	=	__(' Auction ','adforest');
		}
		if( $price_type != "" )
			$price_type_html	=	'<span class="'.esc_attr($class).'">('.$price_type.')</span>';
	}
	
	return $price . $price_type_html;
}
}

if( !function_exists( 'adforest_get_static_form' ) )
{
function adforest_get_static_form($term_id = '', $post_id = '')
{
		$html = '';
		$display_size = '';
		$price = '';
		$required = '';
		global $adforest_theme;
		$size_arr	=	explode( '-', $adforest_theme['sb_upload_size'] );
		$display_size	=	$size_arr[1];
		$actual_size	=	$size_arr[0];	
		//if($term_id == '') return $html;
		// Get Price Field , 
		$vals[] = array(
				'type' 		=> 'select',
				'post_meta'	=> '_adforest_ad_type',
				'is_show' 	=> '_sb_default_cat_ad_type_show',
				'is_req' 	=> '_sb_default_cat_ad_type_required',
				'main_title' 	=> __('Type of Ad', 'adforest'),
				'sub_title' 	=> '',
				'field_name' 	=> 'buy_sell',
				'field_id' 		=> 'buy_sell',
				'field_value' 	=> '',
				'field_req' 	=> 1,
				'cat_name' 	=> 'ad_type',
				'field_class' 		=> ' category ',				
				'columns' 	=> '12',
				'data-parsley-type' => '',
				'data-parsley-message' => __( 'This field is required.', 'adforest' ),
			);
			
			$currency_msg = $adforest_theme['sb_currency'] . " " .  __('only', 'adforest' );
			$currenies	=	adforest_get_cats('ad_currency' , 0 );
			if( count($currenies) > 0 )
			{
				$currency_msg	=	'';	
			}
	
		$vals[] = array(
				'type' 		=> 'textfield',
				'post_meta'	=> '_adforest_ad_price',
				'is_show' 	=> '_sb_default_cat_price_show',
				'is_req' 	=> '_sb_default_cat_price_required',
				'main_title' 	=> __('Price', 'adforest'),
				'sub_title' 	=> $currency_msg,
				'field_name' 	=> 'ad_price',
				'field_id' 		=> 'ad_price',
				'field_value' 	=> $price,
				'field_req' 	=> $required,
				'cat_name' 	=> '',
				'field_class' 		=> '',				
				'columns' 	=> '12',
				'data-parsley-type' => 'digits',
				'data-parsley-message' => __( 'Can\'t be empty and only integers allowed.', 'adforest' ),
			);
			
				 $vals[] = array(
				'type'   => 'select_custom',
				'post_meta' => '_adforest_ad_price_type',
				'is_show'  => '_sb_default_cat_price_type_show',
				'is_req'  => '_sb_default_cat_price_type_required',
				'main_title'  => __('Price Type', 'adforest'),
				'sub_title'  => '',
				'field_name'  => 'ad_price_type',
				'field_id'   => 'ad_price_type',
				'field_value'  => array("Fixed" => __('Fixed','adforest'), "Negotiable" => __('Negotiable','adforest'), 				"on_call" => __('Price on call','adforest'), "auction" => __('Auction', 'adforest'), "free" => __('Free','adforest'), "no_price" => __('No Price','adforest')),
				'field_req'  => $required,
				'cat_name'  => '',
				'field_class'   => ' category ',    
				'columns'  => '12',
				'data-parsley-type' => '',
				'data-parsley-message' => __( 'This field is required.', 'adforest' ),
			   );
$currenies  =  adforest_get_cats('ad_currency' , 0 );
if( isset($currenies) && count($currenies) > 0 )
  {			   
		$vals[] = array(
				'type' 		=> 'select',
				'post_meta'	=> '_adforest_ad_currency',
				'is_show' 	=> '_sb_default_cat_price_show',
				'is_req' 	=> '_sb_default_cat_price_required',
				'main_title' 	=> __('Currency', 'adforest'),
				'sub_title' 	=> '',
				'field_name' 	=> 'ad_currency',
				'field_id' 		=> 'ad_currency',
				'field_value' 	=> '',
				'field_req' 	=> $required,
				'cat_name' 	=> 'ad_currency',
				'field_class' 		=> ' category curreny_class',				
				'columns' 	=> '12',
				'data-parsley-type' => '',
				'data-parsley-message' => __( 'This field is required.', 'adforest' ),
			);
  }
	
		$vals[] = array(
				'type' 		=> 'textfield',
				'post_meta'	=> '_adforest_ad_yvideo',
				'is_show' 	=> '_sb_default_cat_video_show',
				'is_req' 	=> '_sb_default_cat_video_required',
				'main_title' 	=> __('Youtube Video Link', 'adforest'),
				'sub_title' 	=> '',
				'field_name' 	=> 'ad_yvideo',
				'field_id' 		=> 'ad_yvideo',
				'field_value' 	=> '',
				'field_req' 	=> $required,
				'cat_name' 	=> '',
				'field_class' 		=> '',				
				'columns' 	=> '12',
				'data-parsley-type' => 'url',
				'data-parsley-message' => __( 'This field is required.', 'adforest' ),
			);
		$vals[] = array(
				'type' 		=> 'select',
				'post_meta'	=> '_adforest_ad_condition',
				'is_show' 	=> '_sb_default_cat_condition_show',
				'is_req' 	=> '_sb_default_cat_condition_required',
				'main_title' 	=> __('Item Condition', 'adforest'),
				'sub_title' 	=> '',
				'field_name' 	=> 'condition',
				'field_id' 		=> 'condition',
				'field_value' 	=> '',
				'field_req' 	=> $required,
				'cat_name' 	=> 'ad_condition',
				'field_class' 		=> ' category ',				
				'columns' 	=> '12',
				'data-parsley-type' => '',
				'data-parsley-message' => __( 'This field is required.', 'adforest' ),
			);	
		$vals[] = array(
				'type' 		=> 'select',
				'post_meta'	=> '_adforest_ad_warranty',
				'is_show' 	=> '_sb_default_cat_warranty_show',
				'is_req' 	=> '_sb_default_cat_warranty_required',
				'main_title' 	=> __('Item Warranty', 'adforest'),
				'sub_title' 	=> '',
				'field_name' 	=> 'ad_warranty',
				'field_id' 		=> 'warranty',
				'field_value' 	=> '',
				'field_req' 	=> $required,
				'cat_name' 	=> 'ad_warranty',
				'field_class' 		=> ' category ',				
				'columns' 	=> '12',
				'data-parsley-type' => '',
				'data-parsley-message' => __( 'This field is required.', 'adforest' ),
			);		

	
		$vals[] = array(
				'type' 		=> 'image',
				'post_meta'	=> '',
				'is_show' 	=> '_sb_default_cat_image_show',
				'is_req' 	=> '_sb_default_cat_image_required',
				'main_title' 	=> __('Click the box below to ad photos!', 'adforest'),
				'sub_title' 	=> __('upload only jpg, png and jpeg files with a max file size of ','adforest'). $display_size,
				'field_name' 	=> 'dropzone',
				'field_id' 		=> 'dropzone',
				'field_value' 	=> '',
				'field_req' 	=> $required,
				'cat_name' 	=> '',
				'field_class' 		=> ' dropzone ',				
				'columns' 	=> '12',
				'data-parsley-type' => '',
				'data-parsley-message' => __( 'This field is required.', 'adforest' ),
			);	
	
		$vals[] = array(
				'type' 		=> 'textfield',
				'post_meta'	=> '',
				'is_show' 	=> '_sb_default_cat_tags_show',
				'is_req' 	=> '_sb_default_cat_tags_required',
				'main_title' 	=> __('Tags', 'adforest'),
				'sub_title' 	=> __('Comma(,) separated', 'adforest' ) ,
				'field_name' 	=> 'tags',
				'field_id' 		=> 'tags',
				'field_value' 	=> '',
				'field_req' 	=> $required,
				'cat_name' 	=> 'ad_tags',
				'field_class' 		=> '',				
				'columns' 	=> '12',
				'data-parsley-type' => '',
				'data-parsley-message' => __( 'This field is required.', 'adforest' ),
			);	
		
		
		foreach($vals as $val )
		{
			$type = $val['type'];
			$html .= adforest_return_input($type, $post_id, $term_id, $val);		
		}
	
	return $html;
	
}	
}

if ( ! function_exists( 'adforest_html_bidding_system' ) ) {
function adforest_html_bidding_system( $pid )
{
   global $adforest_theme;
   ?>
   <div class="list-style-1 margin-top-30">
   <div class="panel with-nav-tabs panel-default">
	  <div class="panel-heading">
		 <ul class="nav nav-tabs">
			<li class="active">
			<a href="#tab2default" data-toggle="tab" aria-expanded="false">
			<?php echo esc_html( $adforest_theme['sb_comments_section_title'] ); ?>
			</a>
			</li>
		 </ul>
	  </div>
		  <div class="panel-body" >
			 <div class="tab-content">
				<div class="tab-pane fade active in" id="tab2default">
				<div class="bidding" style=" position: relative; overflow: hidden; max-height:325px;">
				
					<?php echo adforest_bidding_html( $pid ); ?> 
				</div>
		   <div class="chat-form ">
  <form role="form" id="sb_bid_ad" >
  
	 <?php
	 $col	=	8;
	 ?>
	 <div class="col-md-2 no-padding">
		<input name="bid_amount" placeholder="<?php echo __ ('Bid','adforest'); ?>" class="form-control" type="text" data-parsley-required="true" data-parsley-type="integer" data-parsley-error-message="<?php echo __( 'Only integers.', 'adforest' ); ?>" autocomplete="off" />
	 </div>
	 <div class="col-md-<?php echo esc_attr($col); ?>">   
		<input name="bid_comment" data-parsley-required="true" data-parsley-error-message="<?php echo __( 'This field is required.', 'adforest' ); ?>" placeholder="<?php echo __ ('Comments...','adforest'); ?>" class="form-control" type="text" autocomplete="off">
		<small><em><?php echo esc_html( $adforest_theme['sb_comments_section_note']); ?></em></small>
	 </div>   
	<div class="col-md-2">
	 <button class="btn btn-theme" type="submit"><?php echo __ ('Send','adforest'); ?></button>
	 <input type="hidden" name="ad_id" value="<?php echo esc_attr($pid) ?>" />
	 </div>
  </form>
</div>
		</div>
	 </div>
  </div>
</div>
	</div>
   <?php
}
}

if ( ! function_exists( 'adforest_get_feature_text' ) ) {
function adforest_get_feature_text($pid)
{
?>
<div role="alert" class="alert alert-info alert-dismissible <?php echo adforest_alert_type(); ?>">
<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">&#10005;</span></button>
<?php echo __('Mark as featured AD,','adforest'); ?>

<a href="javascript:void(0);" class="sb_anchor" data-btn-ok-label="<?php echo __('Yes','adforest'); ?>" data-btn-cancel-label="<?php echo __('No','adforest'); ?>" data-toggle="confirmation" data-singleton="true" data-title="<?php echo __('Are you sure?','adforest'); ?>" data-content="" id="sb_feature_ad" aaa_id="<?php echo esc_attr( $pid ); ?>">
<?php echo __('Make it Now.','adforest'); ?>
</a>

</div>

<?php		 
}
}

add_filter( 'register_post_type_args', 'adforest_register_post_type_args', 10, 2 );
if ( ! function_exists( 'adforest_register_post_type_args' ) ) {
function adforest_register_post_type_args( $args, $post_type ) {
	$adforest_theme_values = get_option('adforest_theme');
	if( isset( $adforest_theme_values['sb_url_rewriting_enable'] ) && $adforest_theme_values['sb_url_rewriting_enable'] && isset( $adforest_theme_values['sb_ad_slug'] ) && $adforest_theme_values['sb_ad_slug'] != "" )
	{
		
		if ( 'ad_post' === $post_type  )
		{
			$old_slug	=	'ad';
			if( get_option( 'sb_ad_old_slug' ) != "" )
			{
				$old_slug	=	get_option( 'sb_ad_old_slug' );	
			}
			$args['rewrite']['slug'] = $adforest_theme_values['sb_ad_slug'];
			update_option( 'sb_ad_old_slug', $adforest_theme_values['sb_ad_slug'] );
			if( ($current_rules = get_option('rewrite_rules')) ) {
				foreach($current_rules as $key => $val) {
					if(strpos($key, $old_slug) !== false)
					{
						add_rewrite_rule(str_ireplace($old_slug, $adforest_theme_values['sb_ad_slug'], $key), $val, 'top');   
					}
				}
	
			}
	}
	}
	
	
	// ...and we flush the rules
	flush_rewrite_rules();
    return $args;
}
}

if ( ! function_exists( 'adforest_video_icon' ) ) {
function adforest_video_icon(  $is_grid2 = false )
{
	global $adforest_theme;
	
		$fet_cls	=	'';
		if( $is_grid2 &&  get_post_meta( get_the_ID(), '_adforest_is_feature', true ) == '1' )
		{
			$fet_cls	=	'video_position';
		}

	
	if( isset( $adforest_theme['sb_video_icon'] ) && $adforest_theme['sb_video_icon'] && get_post_meta(get_the_ID(), '_adforest_ad_yvideo', true ) )
	{
		return '<a href="'.get_post_meta(get_the_ID(), '_adforest_ad_yvideo', true ).'" class="play-video '.esc_attr($fet_cls).'"><i class="fa fa-play-circle-o"></i></a>';	
	}	
}
}

if ( ! function_exists( 'adforest_randomString' ) ) {
function adforest_randomString($length = 50) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
}

if ( ! function_exists( 'adforest_alert_type' ) ) {
function adforest_alert_type()
{
	global $adforest_theme;
	$type = '';
	if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
	{
		$type = 'alert-outline';
	}
	return $type;
}
}

if ( ! function_exists( 'adforest_search_layout' ) ) {
function adforest_search_layout()
{
	global $adforest_theme;
	$widget_layout	= 'sidebar';
	if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design'] ) && $adforest_theme['search_design'] == 'topbar' )
	{
		$widget_layout	= 'topbar';
	}
	else if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' && isset($adforest_theme['search_design'] ) && $adforest_theme['search_design'] == 'map' )
	{
		$widget_layout	= 'map';
	}
	return $widget_layout;
}
}

if ( ! function_exists( 'adforest_widget_counter' ) ) {
function adforest_widget_counter( $return = false)
{
	global $adforest_theme;
	$GLOBALS['widget_counter']	+= 1;
	if( $GLOBALS['widget_counter'] == $adforest_theme['search_widget_limit'] )
	{
		if( $return )
			return '<a href="javascript:void();" class="adv-srch">'.__('Advance Search', 'adforest' ).'</a>';
		else
			echo '<a href="javascript:void();" class="adv-srch">'.__('Advance Search', 'adforest' ).'</a>';
	}

}
}

if ( ! function_exists( 'adforest_advance_search_container' ) ) {
function adforest_advance_search_container( $return = false )
{
	global $adforest_theme;
	if( $GLOBALS['widget_counter'] == $adforest_theme['search_widget_limit'] )
	{
		if( $return )
			return '<div class="hide_adv_search">';
		else
			echo '<div class="hide_adv_search">';
	}

}
}


if ( ! function_exists( 'adforest_advance_search_map_container_open' ) ) {
function adforest_advance_search_map_container_open( $return = false )
{
	global $adforest_theme;
	if( $GLOBALS['widget_counter'] % 3 == 0 )
	{
		if( $return )
			return '<div class="seprator"><div class="row">';
		else
			echo '<div class="seprator"><div class="row">';
	}

}
}
if ( ! function_exists( 'adforest_advance_search_map_container_close' ) ) {
function adforest_advance_search_map_container_close( $return = false )
{
	global $adforest_theme;
	if( $GLOBALS['widget_counter'] % 3 == 0 )
	{
		if( $return )
			return '</div></div>';
		else
			echo '</div></div>';
	}

}
}

if ( ! function_exists( 'adforest_get_ad_images' ) ) {
function adforest_get_ad_images($pid)
{
	global $adforest_theme;
	$re_order	=	get_post_meta( $pid, '_sb_photo_arrangement_', true );
	if( $re_order != "" &&  isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
	{
		return explode( ',', $re_order );	
	}
	else
	{
		global $wpdb;
		$query	= "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_parent = '" . $pid . "'";
		$results = $wpdb->get_results( $query, OBJECT );
		return $results;
		//return get_attached_media( 'image',$pid );
	}
}
}

if ( ! function_exists( 'adforest_removeElementsByTagName' ) )
{
function adforest_removeElementsByTagName($tagName, $document) {
  $nodeList = $document->getElementsByTagName($tagName);
  for ($nodeIdx = $nodeList->length; --$nodeIdx >= 0; ) {
    $node = $nodeList->item($nodeIdx);
    $node->parentNode->removeChild($node);
  }
}
}











if ( ! function_exists( 'adforest_display_adLocation' ) ) {	 
function adforest_display_adLocation( $pid )
{
	global $adforest_theme;
	$ad_country = '';
	$type = ''; 
	$type = $adforest_theme['cat_and_location'];
	$ad_country = wp_get_object_terms( $pid,  array('ad_country'), array('orderby' => 'term_group') );
	$all_locations = array();
	foreach($ad_country as $ad_count)
	{
		$country_ads = get_term( $ad_count);
		$item = array(
			'term_id' => $country_ads->term_id, 
			'location' => $country_ads->name
			);
		$all_locations[] = $item;
	}
	$location_html	=	'';
		if(count( $all_locations ) > 0 )
		{
			$limit = count( $all_locations ) - 1;
			for( $i = $limit; $i>=0; $i-- )
			{
				if($type == 'search')
				{
					
				$location_html	.= '<a href="'.get_the_permalink($adforest_theme['sb_search_page']).'?country_id='.$all_locations[$i]['term_id'].'">'.esc_html( $all_locations[$i]['location'] ).'</a>, ';
				}
				else
				{
					$location_html	.= '<a href="'.get_term_link( $all_locations[$i]['term_id'] ).'">'.esc_html( $all_locations[$i]['location'] ).'</a>, ';	
				}
			}
			
		}
	 return rtrim($location_html, ', ');
	
}
}
if ( ! function_exists( 'adforest_social_profiles' ) ) {
	function adforest_social_profiles()
	{
		global $adforest_theme;
		if( isset( $adforest_theme['sb_enable_social_links'] ) && $adforest_theme['sb_enable_social_links'] )
		{
			$social_netwroks 	=	 array( 'facebook' => __('Facebook','adforest'), 'twitter' => __('Twitter','adforest') ,'linkedin' => __('Linkedin','adforest'), 'google-plus' => __('Google+','adforest'));
		}
		else
		{
			$social_netwroks	=	array();	
		}
		return $social_netwroks;
	}
}