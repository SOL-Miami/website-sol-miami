<?php  global $bethlehem_sermon_media_access; ?>

<div class="beth-metabox beth-page-meta">

	<div class="form-group">
		<?php $mb->the_field('mediaurl'); ?>
		<?php $bethlehem_sermon_media_access->setGroupName('nn')->setInsertButtonLabel('Insert This'); ?>

		<label for="beth-page-meta-page-title"><?php echo __( 'Upload Files', 'bethlehem' ); ?></label>
		<p>
		    <?php echo $bethlehem_sermon_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
		    <?php echo $bethlehem_sermon_media_access->getButton(array('label' => __( 'Upload Files', 'bethlehem' ))); ?>
		</p>
	</div>

</div>