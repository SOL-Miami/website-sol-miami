<?php
/**
 * General functions used to integrate this theme with Events.
 *
 * @package bethlehem
 */

/**
 * Events post_type_args override
 * @since 1.0.0
 */
if( ! function_exists( 'bethlehem_events_post_type_args' ) ) {
    function bethlehem_events_post_type_args( $postVenueTypeArgs ) {
    	$postVenueTypeArgs['supports'] = array( 'title', 'editor', 'thumbnail');
    	return $postVenueTypeArgs;
    }
}

/**
 * Events social share icons
 * @since 1.0.0
 */
if( ! function_exists( 'bethlehem_events_social_share_icons' ) ) {
    function bethlehem_events_social_share_icons() {
    	$eventurl = tribe_get_event_website_url();
    	$eventurl = ( !empty( $eventurl ) ? $eventurl : get_permalink() );
    	$share_icons = apply_filters( 'bethlehem_events_social_share_icons_args', array(
                'facebook'		=> array( 'class' => 'hb-fb', 'icon' => 'fa fa-facebook', 'share_link' => 'https://www.facebook.com/sharer/sharer.php?u=%s' ),
                'twitter'		=> array( 'class' => 'hb-tw', 'icon' => 'fa fa-twitter', 'share_link' => 'https://twitter.com/home?status=%s' ),
                'google_plus'	=> array( 'class' => 'hb-google-plus', 'icon' => 'fa fa-google-plus', 'share_link' => 'https://plus.google.com/share?url=%s' )
            ));
    	?>
    	<ul class="hb-social">
    		<?php foreach ($share_icons as $share_icon) : ?>
    				<li class="<?php echo esc_attr( $share_icon['class'] ); ?>"><a href="<?php echo esc_attr( sprintf( $share_icon['share_link'], $eventurl )); ?>"><i class="<?php echo esc_attr( $share_icon['icon'] ); ?>"></i></a></li>
    		<?php endforeach; ?>
    	</ul>
    	<?php
    }
}

/**
 * Event Title Override
 */
if( ! function_exists( 'bethlehem_get_events_title' ) ) {
    function bethlehem_get_events_title( $depth = true ) {

    	global $wp_query;

    	$tribe_ecp = Tribe__Events__Main::instance();

    	$title = __( 'Upcoming Events', 'bethlehem' );

    	// If there's a date selected in the tribe bar, show the date range of the currently showing events
    	if ( isset( $_REQUEST['tribe-bar-date'] ) && $wp_query->have_posts() ) {

    		if ( $wp_query->get( 'paged' ) > 1 ) {
    			// if we're on page 1, show the selected tribe-bar-date as the first date in the range
    			$first_event_date = tribe_get_start_date( $wp_query->posts[0], false );
    		} else {
    			//otherwise show the start date of the first event in the results
    			$first_event_date =  tribe_format_date( $_REQUEST['tribe-bar-date'], false );
    		}

    		$last_event_date = tribe_get_end_date( $wp_query->posts[count( $wp_query->posts ) - 1], false );
    		$title = sprintf( __( 'Events for %1$s - %2$s', 'bethlehem'), $first_event_date, $last_event_date );
    	} elseif ( tribe_is_past() ) {
    		$title = __( 'Past Events', 'bethlehem' );
    	}

    	if ( tribe_is_month() ) {
    		$title = sprintf(
    			__( '%s', 'bethlehem' ),
    			date_i18n( tribe_get_option( 'monthAndYearFormat', 'F Y' ), strtotime( tribe_get_month_view_date() ) )
    		);
    	}

    	// day view title
    	if ( tribe_is_day() ) {
    		$title = __( 'Events for', 'bethlehem' ) . ' ' .
    				 date_i18n( tribe_get_date_format( true ), strtotime( $wp_query->get( 'start_date' ) ) );
    	}

    	if ( is_tax( $tribe_ecp->get_event_taxonomy() ) && $depth ) {
    		$cat = get_queried_object();
    		$title = '<a href="' . esc_url( tribe_get_events_link() ) . '">' . $title . '</a>';
    		$title .= ' &#8250; ' . $cat->name;
    	}

    	return apply_filters( 'tribe_get_events_title', $title, $depth );
    }
}

if( ! function_exists( 'bethlehem_get_events_link' ) ) {
    function bethlehem_get_events_link() {
    	?>
    	<div class="tribe-events-link">
    		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>" rel="bookmark"><?php  echo apply_filters( 'tribe_events_link_text', __( 'See rest of events', 'bethlehem' ) ); ?></a>
    	</div>
    	<?php
    }
}

if( ! function_exists( 'bethlehem_events_widget_meta' ) ) {
    function bethlehem_events_widget_meta() {
    	$event_id = get_the_ID();
    	echo tribe_get_start_time( $event_id );
    	echo '<div class="venue">' .tribe_get_venue(). '</div>';
    }
}

if( ! function_exists( 'bethlehem_events_widget_date_meta' ) ) {
    function bethlehem_events_widget_date_meta() {
    	$event_id = get_the_ID();
    	?>
    	<div class="date-meta">
    		<?php echo tribe_get_start_date( $event_id, false, 'd' ); ?>
    		<span><?php echo tribe_get_start_date( $event_id, false, 'M' ); ?></span>
    	</div>
    	<?php
    }
}

if( ! function_exists( 'bethlehem_get_event_categories' ) ) {
    function bethlehem_get_event_categories() {
    	$event_id = get_the_ID();
    	echo '<div class="cat-links">' .get_the_term_list( $event_id, 'tribe_events_cat','',',',''). '</div>';
    }
}

if( ! function_exists( 'bethlehem_events_wrapper_before' ) ) {
    function bethlehem_events_wrapper_before( $html ) {
    	$wrapper_before = '<section id="primary" class="content-area"><main id="main" class="site-main">';
    	return $wrapper_before . $html;
    }
}

if( ! function_exists( 'bethlehem_events_wrapper_after' ) ) {
    function bethlehem_events_wrapper_after( $html ) {
    	$wrapper_after = '</main></section>';
    	return $html . $wrapper_after;
    }
}

if( ! function_exists( 'bethlehem_events_sidebar' ) ) {
    function bethlehem_events_sidebar( $html ) {
    	ob_start();
    	echo $html;
    	$layout = bethlehem_get_layout();
    	if( ! ('bethlehem-full-width-content' === $layout || 'page-template-template-fullwidth-php' === $layout ) ) {
    		get_sidebar( 'events' );
    	}
    	$html = ob_get_contents();
    	ob_end_clean();
    	return $html;
    }
}

if( ! function_exists( 'bethlehem_get_events_month_prev_link' ) ) {
    function bethlehem_get_events_month_prev_link() {
        $html = '';
        $url  = tribe_get_previous_month_link();
        $date = Tribe__Events__Main::instance()->previousMonth( tribe_get_month_view_date() );
        $earliest_event_date = tribe_events_earliest_date( Tribe__Date_Utils::DBYEARMONTHTIMEFORMAT );

        if ( $earliest_event_date && $date >= $earliest_event_date ) {
            $html = '<a data-month="' . $date . '" href="' . esc_url( $url ) . '" rel="prev"></a>';
        }
        else {
            $html = '<a href="#" class="disabled"></a>';
        }

        return $html;
    }
}

if( ! function_exists( 'bethlehem_get_events_month_next_link' ) ) {
    function bethlehem_get_events_month_next_link() {
        $html = '';
        $url  = tribe_get_next_month_link();

        if ( ! empty( $url ) ) {
            $date = Tribe__Events__Main::instance()->nextMonth( tribe_get_month_view_date() );

            if ( $date <= tribe_events_latest_date( Tribe__Date_Utils::DBYEARMONTHTIMEFORMAT ) ) {
                $html = '<a data-month="' . $date . '" href="' . esc_url( $url ) . '" rel="next"></a>';
            }
            else {
                $html = '<a href="#" class="disabled"></a>';
            }
        }
        else {
            $html = '<a href="#" class="disabled"></a>';
        }

        return $html;
    }
}

if( ! function_exists( 'get_events_calendar' ) ) {
    function get_events_calendar($initial = true, $echo = true) {
        global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;
        
        $events_archive_link = tribe_get_events_link();
        $events_day_link = $events_archive_link.'&eventDisplay=day&tribe-bar-date=';
        $events_month_link = $events_archive_link.'&eventDisplay=month&tribe-bar-date=';
     
        $key = md5( $m . $monthnum . $year );
        if ( $cache = wp_cache_get( 'get_events_calendar', 'calendar' ) ) {
            if ( is_array($cache) && isset( $cache[ $key ] ) ) {
                if ( $echo ) {
                    /** This filter is documented in wp-includes/general-template.php */
                    echo apply_filters( 'get_events_calendar', $cache[$key] );
                    return;
                } else {
                    /** This filter is documented in wp-includes/general-template.php */
                    return apply_filters( 'get_events_calendar', $cache[$key] );
                }
            }
        }
     
        if ( !is_array($cache) )
            $cache = array();
     
        // Quick check. If we have no posts at all, abort!
        if ( !$posts ) {
            $gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = 'tribe_events' AND post_status = 'publish' LIMIT 1");
            if ( !$gotsome ) {
                $cache[ $key ] = '';
                wp_cache_set( 'get_events_calendar', $cache, 'calendar' );
                return;
            }
        }
     
        if ( isset($_GET['w']) )
            $w = ''.intval($_GET['w']);
     
        // week_begins = 0 stands for Sunday
        $week_begins = intval(get_option('start_of_week'));
     
        // Let's figure out when we are
        if ( !empty($monthnum) && !empty($year) ) {
            $thismonth = ''.zeroise(intval($monthnum), 2);
            $thisyear = ''.intval($year);
        } elseif ( !empty($w) ) {
            // We need to get the month from MySQL
            $thisyear = ''.intval(substr($m, 0, 4));
            $d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
            $thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
        } elseif ( !empty($m) ) {
            $thisyear = ''.intval(substr($m, 0, 4));
            if ( strlen($m) < 6 )
                    $thismonth = '01';
            else
                    $thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
        } else {
            $thisyear = gmdate('Y', current_time('timestamp'));
            $thismonth = gmdate('m', current_time('timestamp'));
        }
     
        $unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);
        $last_day = date('t', $unixmonth);
     
        // Get the next and previous month and year with at least one post
        $previous = $wpdb->get_row("SELECT MONTH(meta_value) AS month, YEAR(meta_value) AS year
            FROM ( SELECT * FROM $wpdb->posts LEFT OUTER JOIN $wpdb->postmeta
            ON $wpdb->posts.ID=$wpdb->postmeta.post_id WHERE $wpdb->posts.post_type = 'tribe_events' AND $wpdb->postmeta.meta_key = '_EventStartDate' ) AS dom
            WHERE meta_value < '$thisyear-$thismonth-01'
            AND post_type = 'tribe_events' AND post_status = 'publish'
                ORDER BY meta_value DESC
                LIMIT 1");
        $next = $wpdb->get_row("SELECT MONTH(meta_value) AS month, YEAR(meta_value) AS year
            FROM ( SELECT * FROM $wpdb->posts LEFT OUTER JOIN $wpdb->postmeta
            ON $wpdb->posts.ID=$wpdb->postmeta.post_id WHERE $wpdb->posts.post_type = 'tribe_events' AND $wpdb->postmeta.meta_key = '_EventStartDate' ) AS dom
            WHERE meta_value > '$thisyear-$thismonth-{$last_day} 23:59:59'
            AND post_type = 'tribe_events' AND post_status = 'publish'
                ORDER BY meta_value ASC
                LIMIT 1");
     
        /* translators: Calendar caption: 1: month name, 2: 4-digit year */
        $calendar_caption = _x('%1$s %2$s', 'calendar caption', 'bethlehem');
        $calendar_output = '<table id="wp-calendar">
        <caption>' . sprintf($calendar_caption, $wp_locale->get_month($thismonth), date('Y', $unixmonth)) . '</caption>
        <thead>
        <tr>';
     
        $myweek = array();
     
        for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
            $myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
        }
     
        foreach ( $myweek as $wd ) {
            $day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
            $wd = esc_attr($wd);
            $calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
        }
     
        $calendar_output .= '
        </tr>
        </thead>
     
        <tfoot>
        <tr>';
     
        if ( $previous ) {
            $event_month_prev_link = esc_url( add_query_arg( array( 'eventDisplay' => 'month', 'tribe-bar-date' => $previous->year.'-'.$previous->month ),  $events_archive_link ) );
            $calendar_output .= "\n\t\t".'<td colspan="3" id="prev"><a href="' . esc_attr( $event_month_prev_link ) . '"><i class="fa fa-angle-left"></i> ' . $wp_locale->get_month_abbrev($wp_locale->get_month($previous->month)) . '</a></td>';
        } else {
            $calendar_output .= "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
        }
     
        $calendar_output .= "\n\t\t".'<td class="pad">&nbsp;</td>';
     
        if ( $next ) {
            $event_month_next_link = esc_url( add_query_arg( array( 'eventDisplay' => 'month', 'tribe-bar-date' => $next->year.'-'.$next->month ),  $events_archive_link ) );
            $calendar_output .= "\n\t\t".'<td colspan="3" id="next"><a href="' . esc_attr( $event_month_next_link ) . '">' . $wp_locale->get_month_abbrev($wp_locale->get_month($next->month)) . ' <i class="fa fa-angle-right"></i></a></td>';
        } else {
            $calendar_output .= "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
        }
     
        $calendar_output .= '
        </tr>
        </tfoot>
     
        <tbody>
        <tr>';
     
        $daywithpost = array();

        // Get days with posts
        $dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(meta_value) AS dom 
            FROM ( SELECT * FROM $wpdb->posts LEFT OUTER JOIN $wpdb->postmeta
            ON $wpdb->posts.ID=$wpdb->postmeta.post_id WHERE $wpdb->posts.post_type = 'tribe_events' AND $wpdb->postmeta.meta_key = '_EventStartDate' ) AS `join`
            WHERE meta_value >= '{$thisyear}-{$thismonth}-01 00:00:00'
            AND post_type = 'tribe_events' AND post_status = 'publish'
            AND meta_value <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59'", ARRAY_N);
        if ( $dayswithposts ) {
            foreach ( (array) $dayswithposts as $daywith ) {
                $daywithpost[] = $daywith[0];
            }
        }
     
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'camino') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'safari') !== false)
            $ak_title_separator = "\n";
        else
            $ak_title_separator = ', ';
     
        $ak_titles_for_day = array();
        $ak_post_titles = $wpdb->get_results("SELECT ID, post_title, DAYOFMONTH(meta_value) AS dom
            FROM ( SELECT * FROM $wpdb->posts LEFT OUTER JOIN $wpdb->postmeta
            ON $wpdb->posts.ID=$wpdb->postmeta.post_id WHERE $wpdb->posts.post_type = 'tribe_events' AND $wpdb->postmeta.meta_key = '_EventStartDate' ) AS `join` 
            WHERE meta_value >= '{$thisyear}-{$thismonth}-01 00:00:00'
            AND post_type = 'tribe_events' AND post_status = 'publish'
            AND meta_value <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59'");
        if ( $ak_post_titles ) {
            foreach ( (array) $ak_post_titles as $ak_post_title ) {
     
                    /** This filter is documented in wp-includes/post-template.php */
                    $post_title = esc_attr( apply_filters( 'the_title', $ak_post_title->post_title, $ak_post_title->ID ) );
     
                    if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
                        $ak_titles_for_day['day_'.$ak_post_title->dom] = '';
                    if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
                        $ak_titles_for_day["$ak_post_title->dom"] = $post_title;
                    else
                        $ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
            }
        }
     
        // See how much we should pad in the beginning
        $pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
        if ( 0 != $pad )
            $calendar_output .= "\n\t\t".'<td colspan="'. esc_attr($pad) .'" class="pad">&nbsp;</td>';
     
        $daysinmonth = intval(date('t', $unixmonth));
        for ( $day = 1; $day <= $daysinmonth; ++$day ) {
            if ( isset($newrow) && $newrow )
                $calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
            $newrow = false;
     
            if ( $day == gmdate('j', current_time('timestamp')) && $thismonth == gmdate('m', current_time('timestamp')) && $thisyear == gmdate('Y', current_time('timestamp')) )
                $calendar_output .= '<td id="today"><span class="today">';
            else
                $calendar_output .= '<td>';
     
            $event_day_link = esc_url( add_query_arg( array( 'eventDisplay' => 'day', 'tribe-bar-date' => $thisyear.'-'.$thismonth.'-'.$day ),  $events_archive_link ) );
            if ( in_array($day, $daywithpost) ) // any posts today?
                    $calendar_output .= '<a href="' . esc_attr( $event_day_link ) . '" title="' . esc_attr( $ak_titles_for_day[ $day ] ) . "\">$day</a>";
            else
                $calendar_output .= $day;
            
            if ( $day == gmdate('j', current_time('timestamp')) && $thismonth == gmdate('m', current_time('timestamp')) && $thisyear == gmdate('Y', current_time('timestamp')) )
                $calendar_output .= '</span></td>';
            else
                $calendar_output .= '</td>';
     
            if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
                $newrow = true;
        }
     
        $pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
        if ( $pad != 0 && $pad != 7 )
            $calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr($pad) .'">&nbsp;</td>';
     
        $calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";
     
        $cache[ $key ] = $calendar_output;
        wp_cache_set( 'get_events_calendar', $cache, 'calendar' );
     
        if ( $echo ) {
            /**
             * Filter the HTML calendar output.
             *
             * @since 3.0.0
             *
             * @param string $calendar_output HTML output of the calendar.
             */
            echo apply_filters( 'get_events_calendar', $calendar_output );
        } else {
            /** This filter is documented in wp-includes/general-template.php */
            return apply_filters( 'get_events_calendar', $calendar_output );
        }
     
    }
}

if( ! function_exists( 'bethlehem_events_breadcrumb' ) ) {
    function bethlehem_events_breadcrumb( $args = array() ) {

        $args = wp_parse_args( $args, apply_filters( 'bethlehem_events_breadcrumb_defaults', array(
            'delimiter'   => '&nbsp;&#47;&nbsp;',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'bethlehem' )
        ) ) );

        $breadcrumbs = new WC_Breadcrumb();

        if ( $args['home'] ) {
            $breadcrumbs->add_crumb( $args['home'], apply_filters( 'bethlehem_events_breadcrumb_home_url', home_url() ) );
        }

        if( !is_singular( 'tribe_events' ) ) {
            $post_type = get_post_type_object( get_post_type() );
            if ( $post_type ) {
                $breadcrumbs->add_crumb( $post_type->labels->singular_name, tribe_get_events_link() );
            }
        }

        $args['breadcrumb'] = $breadcrumbs->generate();

        if( is_singular( 'tribe_events' ) ) {
            $items_to_find = array( 'Event', '' );
            $key = array_search($items_to_find, $args['breadcrumb']);

            $args['breadcrumb'][$key] = array( 'Event', tribe_get_events_link() );
        }

        wc_get_template( 'global/breadcrumb.php', $args );
    }
}