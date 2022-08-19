<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company[]|\Cake\Collection\CollectionInterface $companies
 */
?>
<div>
    <h3><?= __('会社一覧') ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link(__('追加'), ['action' => 'add'], [
            'class' => 'btn btn-primary px-3 py-1'
        ]) ?>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th><?= $this->Paginator->sort('BusinessCategories.business_category_name', '業種') ?>
                    </th>
                    <th><?= $this->Paginator->sort('company_name', '会社名') ?>
                    </th>
                    <th><?= $this->Paginator->sort('company_kana', '会社名(カナ)') ?>
                    </th>
                    <th class="actions"><?= __('操作') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($companies as $company): ?>
                <tr>
                    <td><?= $company->has('business_category') ? h($company->business_category->business_category_name) : '不明' ?>
                    </td>
                    <td><?= h($company->company_name) ?>
                    </td>
                    <td><?= h($company->company_kana) ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('更新'), ['action' => 'edit', $company->id], [
                            'class' => 'btn btn-sm btn-secondary'
                        ]) ?>
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $company->id], [
                            'confirm' => __('会社 ${0} を削除してもよろしいですか?', $company->id),
                            'class' => 'btn btn-sm btn-danger'
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element('paginator') ?>
</div>