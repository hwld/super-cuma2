<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<div>
    <h3><?= '顧客詳細' ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link('編集', ['action' => 'edit', $customer->id], [
            'class' => 'btn btn-sm btn-secondary'
        ]) ?>
        <?= $this->Html->link('削除', ['action' => 'delete', $customer->id], [
            'confirm' => __('顧客 "{0}" を削除してもよろしいですか?', $customer->name),
            'class' => 'btn btn-sm btn-danger'
        ]) ?>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-bordered">
            <tr>
                <th class="table-light"><?= __('顧客コード') ?>
                </th>
                <td><?= h($customer->customer_cd) ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('顧客名') ?>
                </th>
                <td><?= h($customer->name) ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('顧客名(カナ)') ?>
                </th>
                <td><?= h($customer->kana) ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('会社名') ?>
                </th>
                <td><?= $customer->has('company') ? h($customer->company->company_name) : '' ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('郵便番号') ?>
                </th>
                <td><?= h($customer->zip) ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('都道府県') ?>
                </th>
                <td><?= $customer->has('prefecture') ? h($customer->prefecture->pref_name) : '' ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('住所1') ?>
                </th>
                <td><?= h($customer->address1) ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('住所2') ?>
                </th>
                <td><?= h($customer->address2) ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('電話番号') ?>
                </th>
                <td><?= h($customer->phone) ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('FAX') ?>
                </th>
                <td><?= h($customer->fax) ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('Email') ?>
                </th>
                <td><?= h($customer->email) ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('性別') ?>
                </th>
                <td><?= match ($customer->gender) {
                    1 => '男性',
                    2 => '女性',
                    default => 'その他'
                } ?>
                </td>
            </tr>
            <tr>
                <th class="table-light"><?= __('最終取引日') ?>
                </th>
                <td><?= h($customer->lasttrade) ?>
                </td>
            </tr>
        </table>
    </div>
</div>