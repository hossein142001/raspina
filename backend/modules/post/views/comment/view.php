<?php
use backend\helpers\Html;
use dosamigos\tinymce\TinyMce;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\post\models\Comment */

$this->title = Yii::t('app', 'View Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::beginPanel(Yii::t('app','Status'), 'col-md-3 col-sm-6 col-xs-12', null, ['panel-heading', 'panel-status'], ['panel-body', 'panel-body-detail']) ?>
<?php
$postStatus = $model->getCommentStatus();
echo $postStatus[$model->status];
?>
<?= Html::endPanel() ?>

<?= Html::beginPanel(Yii::t('app','Created At'), 'col-md-3 col-sm-6 col-xs-12', null, ['panel-heading', 'panel-status'], ['panel-body', 'panel-body-detail', 'ltr']) ?>
<?= Yii::$app->date->asDatetime($model->created_at) ?>
<?= Html::endPanel() ?>

<?= Html::beginPanel(Yii::t('app','Sender'), 'col-md-3 col-sm-6 col-xs-12', null, ['panel-heading', 'panel-status'], ['panel-body', 'panel-body-detail']) ?>
<?= $model->name ?>
<?= Html::endPanel() ?>

<?= Html::beginPanel(Yii::t('app','Email'), 'col-md-3 col-sm-6 col-xs-12', null, ['panel-heading', 'panel-status'], ['panel-body', 'panel-body-detail']) ?>
<?= $model->email ?>
<?= Html::endPanel() ?>

<div class="clear"></div>

<?= Html::beginPanel(Yii::t('app', 'Comment')) ?>
    <?php
    $buttons = [];
    if($model->status == 0)
    {
        $buttons[] = 'approve';
    }
    $buttons[] = 'delete';
    echo Html::actionButtons($buttons);
    ?>
    <?= Yii::t('app', 'Sent in') . ' ' . Html::a($model->post->title,['default/view', 'id' => $model->post_id]) ?>
    <br><br>
    <?= $model->text ?>
    <br><br>
    <?= $model->ip ?>
<?= Html::endPanel() ?>

<?= Html::beginPanel(Yii::t('app', 'Reply')) ?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'reply_text')->widget(TinyMce::className(), [
    'options' => ['rows' => 15],
    'language' => 'fa',
    'clientOptions' => [
        'directionality' => "rtl",
        'entity_encoding' => "utf-8",
        'relative_urls' => false,
        'menubar' => false,
        'automatic_uploads' => true,
        'images_upload_url' => 'postAcceptor.php',
        'images_reuse_filename' => true,
        'plugins' => [
            "advlist autolink lists link charmap visualblocks code media table contextmenu image media codesample code"
        ],
        'toolbar' => "underline italic bold styleselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | media image upload table link | code"
    ]
])->label(false) ?>
<?= Yii::t('app', 'After sending reply the comment will be automatically approved and published.') ?>
<div class="form-group center-text">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
<?= Html::endPanel() ?>
