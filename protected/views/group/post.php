<?php
/* @var $this PostController */
/* @var $model Post */
 
//设置SEO
$this->pageTitle = $post->title;
 Yii::app()->clientScript->registerMetaTag(mb_substr(strip_tags($post->content),0,200,'utf8')."...", 'description');
 
$this->widget('booster.widgets.TbBreadcrumbs', array(
    'links'=>array(Yii::t('app','小组')=>array('/group'),
					$group->name=>array('group/view','id'=>$group->id), 
					Yii::t('app','讨论')
 				//	'讨论区'=>array('post/index','groupid'=>$question->groupid),
 					),
 	'homeLink'=>false)); 
 
 ?>
<div class="row dxd-group-body">
	<div class="col-sm-9 dxd-left-col">
		<?php $this->renderPartial('_post_view',array('post'=>$post,'member'=>$member,'group'=>$group))?>
	</div>
	<div class="col-sm-3 dxd-right-col" style="padding-top:0px">
	<?php //echo CHtml::link('<  返回'.$group->name,array('group/view','id'=>$group->id));?>
	
		<div>
		<br/>
	<!-- 关注 -->
	<?php  
	$follows = $followDataProvider->getData();
	$isFan = $post->isFan(Yii::app()->user->id);
	echo CHtml::link($isFan ? Yii::t('app',"取消关注"):Yii::t('app','关  注'),array('post/toggleFollow','id'=>$post->id),array('class'=>'btn btn '.($isFan?"":" btn-success"),'onclick'=>'toggleFollow(this);return false;'))?>
	<!-- 关注结束 -->
		<div style="margin-bottom:20px">
		<?php if($followDataProvider->totalItemCount>0):?>
		<div style="margin:15px 0">
			<span style="font-weight:bold"><?php echo $followDataProvider->totalItemCount;?> </span>
			<?php echo Yii::t('app','人关注了这个帖子')?>
		</div>
			<?php foreach($follows as $follow):
				$img = CHtml::image(Yii::app()->baseUrl."/".DxdUtil::xImage($follow->user->face, 25, 25),$follow->user->name,array('style'=>'width:25px;height:25px;'));
				echo CHtml::link($img,array('//u/index','id'=>$follow->userId),array('class'=>'dxd-username','data-userId'=>$follow->userId,'style'=>'margin-right:5px;'));
			 endforeach;?>
		<?php endif;?>
		</div>
	</div>
	</div>
</div>

<style type="text/css">
.dxd-right-col{
padding-top:40px;
}
</style>
