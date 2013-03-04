    <section class="tab-pane fade" id="pane-list">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'games-grid',
	'dataProvider'=>$games->search(),
	'columns'=>array(
		'name',
		'folder',
		array(
			'headerHtmlOptions'=>array(
				'class'=>'icon',
			),
			'htmlOptions'=>array(
				'class'=>'icon',
			),
			'name'=>'icon',
			'sortable'=>false,
			'type'=>'html',
			'value'=>'CHtml::image(Yii::app()->baseUrl . "/images/games/" . $data->icon, $data->name)',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update} {delete}',
			'updateButtonLabel'=>Yii::t('sourcebans', 'Edit'),
			'updateButtonUrl'=>'Yii::app()->createUrl("games/edit", array("id" => $data->primaryKey))',
			'deleteButtonUrl'=>'Yii::app()->createUrl("games/delete", array("id" => $data->primaryKey))',
		),
	),
	'cssFile'=>false,
	'itemsCssClass'=>'items table table-accordion table-condensed table-hover',
	'pager'=>array(
		'class'=>'bootstrap.widgets.TbPager',
	),
	'pagerCssClass'=>'pagination pagination-right',
	'summaryCssClass'=>'',
	'summaryText'=>false,
)) ?>

    </section>
    <section class="tab-pane fade" id="pane-add">
<?php echo $this->renderPartial('/games/_form', array(
	'action'=>array('games/add'),
	'model'=>$game,
)) ?>

    </section>