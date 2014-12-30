<?php
/* @var $this CourseController */
/* @var $dataProvider CActiveDataProvider */

?>
<div class="row ">
<?php

?>
	<div class="col-sm-2">
		<?php $this->renderPartial('_side_nav',array('keyword'=>$keyword));?>
	</div>
	<div class="col-sm-10">
	<?php $this->renderPartial('_form',array('cate'=>'post','keyword'=>$keyword))?>

	<h5><?php echo Yii::t('app','搜索');?> "<em><b><?php echo CHtml::link($keyword,"#");?>"</b></em><?php echo Yii::t('app','共得');?> <b><?php echo $dataProvider->totalItemCount;?></b> <?php echo Yii::t('app','条帖子相关结果');?></h5>
	<br/>
	<?php $this->widget('booster.widgets.TbListView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>"{items}\n{pager}",
	    'itemView'=>'_post',
		'separator'=>'<div style="margin:20px 0;"><div>',
		'viewData'=>array('keyword'=>$keyword),
		'emptyText'=>false
	)); ?>
	</div>
</div>

