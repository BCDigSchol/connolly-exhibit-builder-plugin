<?php head(array('title'=>'Exhibit Section', 'body_class'=>'exhibits')); ?>
<?php echo js('listsort'); ?>
<script type="text/javascript" charset="utf-8">
	var listSorter = {};
	
	Event.observe(window, 'load', function() {	
		if(!$('page-list')) return;	
		listSorter.list = $('page-list');
		listSorter.form = $('section-form');
		listSorter.editUri = "<?php echo $_SERVER['REQUEST_URI']; ?>";
		listSorter.partialUri = "<?php echo uri('exhibits/page-list'); ?>";
		listSorter.recordId = '<?php echo h($section->id); ?>';
		listSorter.tag = 'li';
		listSorter.handle = 'handle';
		listSorter.overlap = 'horizontal';
		listSorter.constraint = 'horizontal';
		listSorter.confirmation = 'Are you sure you want to delete this page?';
		listSorter.deleteLinks = 'a.delete-page';
								
		if(listSorter.list) {
			//Create the sortable list
			makeSortable(listSorter.list);
		};
	});
</script>
<?php common('exhibits-nav'); ?>
<div id="primary">
	<h1>Add Exhibit</h1>

<?php 
	echo flash();
?>

<form method="post" accept-charset="utf-8" action="" id="section-form" class="exhibit-builder">
			
		<?php 
		//	submit('Exhibit', 'exhibit_form');
		//	submit('New Page', 'page_form'); 
		?>
		
	<fieldset>
		<legend>Section Meta</legend>
		
		
		
	<div class="field"><?php echo text(array('name'=>'title', 'id'=>'title', 'class'=>'textinput'), $section->title, 'Title for the Section'); ?></div>
		<div class="field"><?php echo text(array('name'=>'slug','id'=>'slug','class'=>'textinput'), $section->slug, 'URL Slug (optional)'); ?></div>
	<div class="field"><?php echo textarea(array('name'=>'description', 'id'=>'description', 'class'=>'textinput','rows'=>'10','cols'=>'40'), $section->description, 'Section Description'); ?></div>	

	</fieldset>
		<fieldset id="section-pages">
			<legend>Pages in This Section</legend>	
	<?php if ( section_has_pages($section) ): ?>
		<p>To reorder pages, click and drag the page thumbnail to the left or right.</p>
			<ul id="page-list">
			<?php common('page-list', compact('section'), 'exhibits'); ?>

			</ul>
		<button type="submit" name="page_form" id="page_form" class="inline-button">Add a Page</button>
	<?php else: ?>
		<p>There are no pages in this section. <button type="submit" name="page_form" id="page_form" class="inline-button">Add a Page</button>
		</p>
	<?php endif; ?>
	</fieldset>

	<fieldset>
		<p><button type="submit" name="exhibit_form">Save and Return to Exhibit</button> or <button type="submit" name="cancel_section" id="cancel_section" class="cancel">Cancel</button></p>
	</fieldset>
</form>

<?php /*if ( $section->exists() ): ?>
	<form action="<?php echo uri('exhibits/delete-section/'.$section->id); ?>">
		<input type="submit" name="submit" value="Delete this Section" />
	</form>
<?php endif;*/ ?>
</div>
<?php foot(); ?>