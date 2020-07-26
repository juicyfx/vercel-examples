<?php Block::put('breadcrumb') ?>
    <ul>
        <li><a href="<?= Backend::url('rainlab/user/users') ?>"><?= e(trans('rainlab.user::lang.users.menu_label')) ?></a></li>
        <li><?= e(trans($this->pageTitle)) ?></li>
    </ul>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>

    <?php Block::put('form-contents') ?>

        <?php if ($formModel->is_guest): ?>
            <?= $this->makePartial('hint_guest') ?>
        <?php elseif ($formModel->isBanned()): ?>
            <?= $this->makePartial('hint_banned') ?>
        <?php elseif ($formModel->trashed()): ?>
            <?= $this->makePartial('hint_trashed') ?>
        <?php elseif (!$formModel->is_activated): ?>
            <?= $this->makePartial('hint_activate') ?>
        <?php endif ?>

        <div class="scoreboard">
            <div data-control="toolbar">
                <?= $this->makePartial('preview_scoreboard') ?>
            </div>
        </div>

        <div class="form-buttons">
            <div class="loading-indicator-container">
                <?= $this->makePartial('preview_toolbar') ?>
            </div>
        </div>

        <div class="layout-row min-size">
            <?= $this->formRender(['preview' => true, 'section' => 'outside']) ?>
        </div>

        <div class="layout-row">
            <?= $this->formRender(['preview' => true, 'section' => 'primary']) ?>
        </div>

    <?php Block::endPut() ?>

    <?php Block::put('form-sidebar') ?>
        <div class="hide-tabs"><?= $this->formRender(['preview' => true, 'section' => 'secondary']) ?></div>
    <?php Block::endPut() ?>

    <?php Block::put('body') ?>
        <?= Form::open(['class'=>'layout stretch']) ?>
            <?= $this->makeLayout('form-with-sidebar') ?>
        <?= Form::close() ?>
    <?php Block::endPut() ?>

<?php else: ?>

    <div class="padded-container container-flush">
        <p class="flash-message static error"><?= e($this->fatalError) ?></p>
        <p><a href="<?= Backend::url('rainlab/user/users') ?>" class="btn btn-default"><?= e(trans('rainlab.user::lang.users.return_to_list')) ?></a></p>
    </div>

<?php endif ?>
