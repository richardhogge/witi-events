<?php
/**
 * Adds WITI_Events widget
 */
class WITI_Events_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress
	 */
	function __construct() {
		parent::__construct(
			'witievents_widget', // Base ID
			esc_html__( 'WITI Events', 'witi_domain' ), // Name
			array( 'description' => esc_html__( 'Displays a feed of WITI events.', 'witi_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments
	 * @param array $instance Saved values from database
	 */
	public function widget( $args, $instance ) {
    echo $args['before_widget']; // Whatever you want to display before widget (<div>, etc.)
  
		// if ( ! empty( $instance['title'] ) ) {
		// 	echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    // }
    
    // Widget content output
		$response = wp_remote_get( 'https://witi.com/api/events/all/index.php' ); // Get all upcoming conferences and networks events from API endpoint 

		if ( is_array( $response ) && ! is_wp_error( $response ) ) {
			$data = json_decode( $response['body'], true );
		}

		// Count events
		$events = count( $data );
?>

<?php if ( $events > 0 ) : ?>

<ul>

	<?php for ( $i = 0; $i < $events; $i++ ) { ?>

	<li>
		<a href="<?php echo $data[$i]['url']; ?>" target="_blank">
			<?php echo $data[$i]['name']; ?>
		</a><br>
		<?php echo date( 'F m, Y', strtotime( $data[$i]['date_start'] ) ); ?><br>
		Online
	</li>

	<?php	} ?>

</ul>

<?php else : ?>

<p>
	Sorry, there are no upcoming WITI Events at this time. Please visit <a href="https://witi.com" target="_blank">witi.com/events</a> for more details.
</p>
		
<?php endif; ?>

<?php
		echo $args['after_widget']; // Whatever you want to display after widget (</div>, etc.)
	}

	/**
	 * Back-end widget form
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'WITI Events', 'witi_domain' );
?>

<!-- Title -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
		<?php esc_attr_e( 'Title:', 'witi_domain' ); ?>
	</label> 
	<input
		class="widefat"
		id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
		name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
		type="text"
		value="<?php echo esc_attr( $title ); ?>">
</p>

<?php
	}

	/**
	 * Sanitize widget form values as they are saved
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved
	 * @param array $old_instance Previously saved values from database
	 *
	 * @return array Updated safe values to be saved
	 */
	public function update( $new_instance, $old_instance ) {
    $instance = array();
    
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class WITI_Events_Widget