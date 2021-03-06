<div class="webpages form">
<?php echo $this->Form->create('Webpage'); ?>
  
  	<fieldset>
    <?php
	echo $this->Form->input('Webpage.id');
	echo $this->Form->input('Webpage.type', array('type' => 'hidden', 'default' => 'element'));
	echo $this->Form->input('Webpage.name');
	echo $this->Form->input('Webpage.content');	?>
  	</fieldset>
  
	<fieldset>
    	<legend> <?php echo __('Template Settings'); ?> </legend>
      	<?php
		echo $this->Form->input('Webpage.is_default', array('type' => 'checkbox'));
		echo $this->Form->input('Webpage.template_urls', array('type' => 'textarea', 'after' => ' <br>One url per line. (ex. /tickets/tickets/view/*)'));
		echo $this->Form->input('Webpage.user_roles', array('type' => 'select', 'options' => $userRoles, 'multiple' => 'checkbox')); ?>
    </fieldset>
    
<?php
echo $this->Form->end('Save Template'); ?>
</div>


<?php
// CodeMirror !
echo $this->Html->script('ckeditor/plugins/codemirror/js/codemirror.min');
echo $this->Html->script('ckeditor/plugins/codemirror/js/mode/matchbrackets');
echo $this->Html->script('ckeditor/plugins/codemirror/js/mode/htmlmixed');
echo $this->Html->script('ckeditor/plugins/codemirror/js/mode/xml');
echo $this->Html->script('ckeditor/plugins/codemirror/js/mode/javascript');
echo $this->Html->script('ckeditor/plugins/codemirror/js/mode/css');
echo $this->Html->script('ckeditor/plugins/codemirror/js/mode/clike');
echo $this->Html->script('ckeditor/plugins/codemirror/js/mode/php');
echo $this->Html->css('/js/ckeditor/plugins/codemirror/css/codemirror.min');
?>
<script type="text/javascript">
    // code mirror config
    var warn_on_unload = true;
    var editor = CodeMirror.fromTextArea(document.getElementById('WebpageContent'), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "php",
        indentUnit: 4,
        indentWithTabs: true,
        enterMode: "keep",
        tabMode: "shift"
    });

    $('input[type=submit], a.btn-danger').click(function(e) {
        warn_on_unload = false;
    });

    // keyboard short cut for saving
    var isCtrl = false;
    document.onkeyup=function(e){
        if(e.keyCode === 17) isCtrl=false;
    };

    document.onkeydown=function(e) {
        console.log(e.keyCode);
        if(e.keyCode === 17 || e.keyCode === 224) isCtrl = true;
        console.log(e.keyCode);
        if(e.keyCode === 83 && isCtrl === true) {
            //run code for CTRL+S -- ie, save!
            $('#ViewFileEditForm').submit(function() {
            	warn_on_unload = false;
            });
            return false;
        }
    };
    window.onbeforeunload = function() {
    	if (warn_on_unload === true) {
    		return "Are you sure you want to leave this page? (Any changes will be lost)";
    	}
	};
</script>

<style type="text/css">
    .CodeMirror {
        border: 1px solid #ccc;
        margin: 0 0 10px 0;
        border-radius: 0.4em;
        height: auto;
    }
    .CodeMirror-scroll {
        overflow-y: hidden;
        overflow-x: auto;
    }
    .CodeMirror-lines {
	    /*background: none repeat scroll 0 0 #EFEFEF;*/
	    cursor: text;
	    font-size: 1.1em;
	    text-shadow: 0 0 0 #FF0000, 1px 1px 0 #FFFFFF;
	    margin-left: 10px;
	}
	/* control line number placement */
	.CodeMirror-gutters {
    	box-shadow: 11px 0 21px #808080;
    }
	.CodeMirror-linenumber {
		padding: 0 3px 0 7px;
		margin-left: -8px;
	    padding: 0 3px 0 0;
	}
	.CodeMirror .form-group {
		margin-bottom: 0;
	}
</style>

<script type="text/javascript">
$(function() {	
	if ($("#WebpageIsDefault").is(":checked")) {
		$("#WebpageTemplateUrls").parent().hide();
	}

	$("#WebpageIsDefault").change(function() {
		if ($(this).is(":checked")) {
			$("#WebpageTemplateUrls").parent().hide();
		} else {
			$("#WebpageTemplateUrls").parent().show();
		}
	});
});
</script>


<?php /* if (in_array('Drafts', CakePlugin::loaded())) {  ?>
	updateSubmitButton();
	var tid = setInterval(timedDraftSubmit, 30000);

	$("#WebpageDraft").change(function() {
		updateSubmitButton();
	});

	$("#WebpageEditForm").submit(function() {
		if ($("#WebpageDraft").is(":checked")) {
			ajaxDraftSubmit(true)
			return false;
		} else {
			return true;
		}
	});
<?php } ?>
});


function updateSubmitButton() {
	if ($("#WebpageDraft").is(":checked")) {
		$(".submit input").attr("value", "Save Draft & Preview");
	} else {
		$(".submit input").attr("value", "Publish Update");
	}
}

function timedDraftSubmit() {
	if ($("#WebpageDraft").is(":checked")) {
		ajaxDraftSubmit(false)
	}
}


function ajaxDraftSubmit(openwindow) {
	$(".ajaxLoader").show("slow");
	$.ajax({
		type: "POST",
		data: $('#WebpageEditForm').serialize(),
		url: "/webpages/webpages/edit.json" ,
		dataType: "text",
		success:function(data){
			if (openwindow) {
				window.open('/webpages/webpages/view/<?php echo $this->request->data['Webpage']['id']; ?>/draft:1', 'preview')
			}
			$(".ajaxLoader").hide("slow");
		}
	}); */ ?>
	

<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link(__('Admin Dashboard'), '/admin'),
	$this->Html->link(__('All Templates'), array('action' => 'index', 'template')),
	$page_title_for_layout,
)));
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	  array('heading' => 'Webpages',
		'items' => array(
			$this->Html->link(__('List'), array('controller' => 'webpages', 'action' => 'index', 'template')),
			$this->Html->link(__('Add'), array('controller' => 'webpages', 'action' => 'add', 'template'), array('title' => 'Add Webpage')),
			$this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Webpage.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Webpage.id'))),
			)
		)
	)));
