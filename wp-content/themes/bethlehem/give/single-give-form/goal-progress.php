<?php
/**
 * Single Give Form Goal Progress
 *
 * @package       Give/Templates
 * @version       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if( empty( $form_id ) ) {
	$form_id = is_object( $post ) ? $post->ID : 0;
}

$goal_option = get_post_meta( $form_id, '_give_goal_option', true );
$form        = new Give_Donate_Form( $form_id );
$goal        = $form->goal;
$income      = $form->get_earnings();
$goal_format = get_post_meta( $form_id, '_give_goal_format', true );

//Sanity check - respect shortcode args
if ( isset( $args['show_goal'] ) && $args['show_goal'] === false ) {
	return false;
}

//Sanity check - ensure form has goal set to output
if ( empty( $form->ID ) || ( is_singular( 'give_forms' ) && $goal_option !== 'yes' ) || $goal_option !== 'yes' || $goal == 0 ) {
	//not this form, bail
	return false;
}

$progress = round( ( $income / $goal ) * 100, 2 );

if ( $income > $goal ) {
	$progress = 100;
}

if( $goal_format == 'percentage' ) {
	$goal_income_text = $progress . '%';
} else {
	$goal_income_text = give_currency_filter( give_format_amount( $income, false ) );
}

?>
<div class="goal-progress">
	<div class="raised"><?php echo sprintf( _x( '%s of %s raised', 'This text displays the amount of income raised compared to the goal.', 'bethlehem' ), '<span class="income">' . $goal_income_text . '</span>', '<span class="goal-text">' . give_currency_filter( give_format_amount( $goal, false ) ) ) . '</span>'; ?></div>
	<div class="progress-bar">
		<span style="width: <?php echo esc_attr( $progress ); ?>%;"></span>
	</div>
</div><!-- /.goal-progress -->