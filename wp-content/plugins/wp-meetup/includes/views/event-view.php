<?php

class WPMeetupEventView {

	/**
	 * Takes an single event and uses the data to create the display for the event
	 * @param type $event The event object
	 * @param bool $widget Whether or not this is for a widget
	 * @return STRING
	 */
	public static function calendar_view($event, $widget = FALSE, $simple = FALSE) {
		global $wp_meetup;
		$event_raw = unserialize($event->event);
		if ($wp_meetup->options->get_option('link_redirect')) {
			$url = $event->event_url;
		}
		else {
			$url = get_permalink($event->wp_post_id);
		}
		$output = '';
		if ($widget) {
			$output .= '<a href="' . $url . '" title="' . WPMeetupEventView::edit_name($event_raw->name) . '">';
			$output .= '<div class="wpm-single group' . $event->group_id . '">';
			//$output .= date( 'g:i A',$event->event_time);
			$output .= '<br />';
			$output .= '</div>';
			$output .= '</a>';
		} else {
			$output .= '<a href="' . $url . '">';
			$output .= '<div class="wpm-single group' . $event->group_id . '">';
			$output .= date( 'g:i A',$event->event_time) . ' - ' . WPMeetupEventView::edit_name($event_raw->name);
			$output .= '</div></a>';
		}
		return $output;
	}

	/**
	 * Takes a single event and creates the appropriate list view
	 * @param type $event
	 * @param bool $widget
	 * @return string
	 */
	public static function list_view($event, $widget = FALSE, $simple = FALSE) {
		global $wp_meetup;
		$event_raw = unserialize($event->event);
		$target;
		if ($wp_meetup->options->get_option('link_redirect')) {
			$url = $event->event_url;
			$target = '_blank';
		}
		else {
			$url = get_permalink($event->wp_post_id);
			$target = '';
		}
		$event_raw = unserialize($event->event);
		$output = '';

		if ($widget || $simple) {
			$output .= '<div class="wpm-event-listing">';
			$output .= '<div class="wpm-date-display group' . $event->group_id . '">';
			$output .= '<span class="month">' . date( 'M',$event->event_time) . '</span>';
			$output .= '<span class="day">' . date( 'j',$event->event_time) . '</span>';
			$output .= '</div>';
			$output .= '<div class="widget-meetup-event-list-day">';
			$output .= '<div class="wpm-single">';
			$output .= '<a href="' . $url . '" target="' . $target . '">';
			$output .= $event_raw->name;
			$output .= '</a>';
			$output .= '<span class="date">' . date( 'F j, Y', $event->event_time ) . ' at ' . date( 'g:i a', $event->event_time ) . '</span>';
			$output .= '<a class="event-more" href="' . $url . '" target="' . $target . '">' . 'Learn more' . '</a>';
			$output .= '</div></div>';
			$output .= '</div>';
		} else {
			/* Container <div>s */
			$output .= '<div class="third columns">';
			$output .= '<div class="holder">';
			/* Featured image and link */
			$output .= '<a href="' . $url . '" target="' . $target . '">';
			$output .=  get_the_post_thumbnail( $event->wp_post_id, 'full', array( 'class' => 'event-thumb' ) );
			$output .= '</a>';
			/* Title */
			$output .= '<div class="information">';
			$output .= '<h2 class="title text-center">';
			$output .= '<a href="' . $url . '" target="' . $target . '">';
			$output .= $event_raw->name;
			$output .= '</a>';
			$output .= '</h2>';
			$output .= '<div class="excerpt">';
			$output .= '<p class="subtitle text-center">' . date( 'F j, Y',$event->event_time) . ' at ' .date( 'g:i a',$event->event_time) . '</p>';
			$output .= '<span class="border-line"></span>';
			$output .= '<p>';
			$end = 225;
			if (strlen($event_raw->description) < $end) {$end = strlen($event_raw->description);}
			$output .= substr($event_raw->description, 0, $end) . '... ';
			// $output .= $event->post_excerpt;
			$output .= '<a href="' . $url . '" target="' . $target . '">';
			$output .= 'Read More';
			$output .= '</p>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
		}

		return $output;
	}

	public static function edit_name($event_name) {
		$new_name = '';
		$c = 0;
		$name_array = explode( " ", $event_name);
		foreach ($name_array as $word) {
			$c++;
			if (strlen($word) > 10) {
				$new_name .= substr($word, 0 , 7) . '...';
				return $new_name;
			}
			else if ($c == 5) {
				$new_name .= $word . '...';
				return $new_name;
			}
			else {
				$new_name .= $word . ' ';
			}
		}
		return $new_name;
	}
}
