<?php
/* @var $this GroupsController */
/* @var $model SBServerGroup */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'server-group-form',
	'action'=>isset($action) ? $action : null,
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'inputContainer'=>'.control-group',
		'validateOnSubmit'=>true,
	),
	'errorMessageCssClass'=>'help-inline',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
	),
)) ?>

  <div class="control-group">
    <?php echo $form->labelEx($model,'name',array('class' => 'control-label')); ?>
    <div class="controls">
      <?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32)); ?>
      <?php echo $form->error($model,'name'); ?>
    </div>
  </div>

  <div class="control-group">
    <?php echo $form->labelEx($model,'immunity',array('class' => 'control-label')); ?>
    <div class="controls">
      <?php echo $form->numberField($model,'immunity'); ?>
      <?php echo $form->error($model,'immunity'); ?>
    </div>
  </div>

  <div class="flags control-group">
    <?php echo $form->label($model,'flags',array('class' => 'control-label')); ?>
    <div class="controls">
<?php foreach(SourceBans::app()->flags as $flag => $description): ?>
      <?php $checkbox = CHtml::checkBox('SBServerGroup[flags]['.$flag.']', strpos($model->flags, $flag) !== false, array('value'=>$flag)) . $description; ?>
      <?php echo CHtml::label($checkbox,'SBServerGroup_flags_' . $flag,array('class' => 'checkbox')); ?>
<?php endforeach ?>
      <?php echo CHtml::hiddenField('SBServerGroup[flags]'); ?>
      <?php echo $form->error($model,'flags'); ?>
    </div>
  </div>

  <div class="control-group buttons">
    <div class="controls">
      <?php echo CHtml::submitButton(Yii::t('sourcebans', 'Save'),array('class' => 'btn')); ?>
    </div>
  </div>

<?php $this->endWidget() ?>

<?php Yii::app()->clientScript->registerScript('flags_change', '
  $("#SBServerGroup_flags_z").change(function() {
    $(".flags :checkbox").prop("checked", $(this).is(":checked"));
    
    $("#SBServerGroup_flags").val($(this).is(":checked") ? "' . SM_ROOT . '" : "");
  });
  $(".flags :checkbox").not("#SBServerGroup_flags_z").change(function() {
    $("#SBServerGroup_flags_z").prop("checked", $(".flags :checkbox").not("#SBServerGroup_flags_z").are(":checked"));
    
    if(!$("#SBServerGroup_flags_z").is(":checked")) {
      $("#SBServerGroup_flags").val("");
      $(".flags :checkbox:checked").each(function(i, el) {
        $("#SBServerGroup_flags")[0].value += $(el).val();
      });
    }
  });
  
  if($("#SBServerGroup_flags_z").is(":checked")) {
    $("#SBServerGroup_flags_z").trigger("change");
  }
') ?>