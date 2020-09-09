<?php
use \yii\helpers\Html;

use yii\helpers\HtmlPurifier;

//echo \yii\helpers\HtmlPurifier::process($name);
?>
<p><?=Html::encode($name);?></p>
<p><?=HtmlPurifier::process($name)?></p>




