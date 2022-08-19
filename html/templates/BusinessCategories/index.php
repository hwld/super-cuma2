<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BusinessCategory[]|\Cake\Collection\CollectionInterface $businessCategories
 */
?>
<div>
    <h3><?= __('業種一覧') ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link(__('追加'), ['action' => 'add'], ['class' => 'btn btn-primary px-3 py-1']) ?>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th><?= $this->Paginator->sort('business_category_name', '業種') ?>
                    </th>
                    <th class="actions"><?= __('操作') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($businessCategories as $businessCategory): ?>
                <tr>
                    <td><?= h($businessCategory->business_category_name) ?>
                    </td>
                    <td>
                        <?= $this->Html->link(__('更新'),
                            ['action' => 'edit', $businessCategory->id],
                            ['class' => 'btn btn-sm btn-secondary']
                        ) ?>
                        <?= $this->Form->postLink(__('削除'),
                            ['action' => 'delete', $businessCategory->id],
                            [
                                'confirm' => __('カテゴリ "{0}" を削除してもよろしいですか？', $businessCategory->business_category_name),
                                'class' => 'btn btn-sm btn-danger'
                            ],
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element('paginator') ?>
</div>