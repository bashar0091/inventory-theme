<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

ob_start();

$cost_text = $args['cost_text'] ?? '';
$cost_type = $args['cost_type'] ?? '';
$sell_new = $args['sell_new'] ?? '';
$quotation_new = $args['quotation_new'] ?? '';
$account = $args['account'] ?? '';
$formClass = '';
if ($sell_new) {
    $formClass = 'sell_submission_form';
} elseif ($quotation_new) {
    $formClass = 'quotation_submission_form';
} elseif ($account) {
    $formClass = 'account_submission_form';
} else {
    $formClass = 'rmb_submission_form';
}
?>
<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
        <h3 class="font-medium text-black dark:text-white">
            <?php if ($sell_new): ?>
                Add Sell
            <?php elseif ($quotation_new): ?>
                Add Quotation
            <?php elseif ($account): ?>
                Information
            <?php else: ?>
                Add <?php echo wp_kses_post($cost_text); ?> Product
            <?php endif; ?>
        </h3>
    </div>
    <form action="#" class="<?php echo esc_attr($formClass); ?>" enctype="multipart/form-data">
        <div class="p-6.5">
            <?php if ($quotation_new): ?>
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Quotation Title', 'quotation_title', 'text', 'Quotation Title', true, ''); ?>
                    </div>
                    <div class="w-full xl:w-1/2">
                        <?php selectv1('Currency', 'currency', 'Select Currency', true, '', optionv1('country'), 'v2') ?>
                    </div>
                </div>

                <hr class="hr1">

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Billing From', 'billing_from', 'text', 'Billing From', true, ''); ?>
                    </div>

                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Billing To', 'billing_to', 'text', 'Billing To', true, ''); ?>
                    </div>
                </div>

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Billing Email', 'billing_email', 'email', 'Billing Email', true, ''); ?>
                    </div>

                    <div class="w-full xl:w-1/2">
                        <?php inputv1('To Email', 'to_email', 'email', 'To Email', true, ''); ?>
                    </div>
                </div>

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Billing Phone', 'billing_phone', 'tel', 'Billing Phone', true, ''); ?>
                    </div>

                    <div class="w-full xl:w-1/2">
                        <?php inputv1('To Phone', 'to_phone', 'tel', 'To Phone', true, ''); ?>
                    </div>
                </div>

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Billing Address', 'billing_address', 'text', 'Billing Address', true, ''); ?>
                    </div>

                    <div class="w-full xl:w-1/2">
                        <?php inputv1('To Address', 'to_address', 'text', 'To Address', true, ''); ?>
                    </div>
                </div>

                <hr class="hr1">

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Invoice ID', 'invoice_id', 'text', 'Invoice ID', true, ''); ?>
                    </div>

                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Date Issued', 'date_issued', 'date', 'Date Issued', true, ''); ?>
                    </div>
                </div>

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Due Amount', 'due_amount', 'number', 'Due Amount', true, ''); ?>
                    </div>

                    <div class="w-full xl:w-1/2">
                    </div>
                </div>

                <hr class="hr1">

                <div class="inventory_repeater">
                    <div data-repeater-list="quotation_products">
                        <div data-repeater-item class="repeatitem">
                            <div class="text-right">
                                <a href="javascript:void(0)" data-repeater-delete class="text-xs text-white bg-danger px-2 py-1 inline-block">Delete Item</a>
                            </div>
                            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                <div class="w-full xl:w-1/2">
                                    <?php inputv1('Item Name', 'item_name', 'text', 'Item Name', true, ''); ?>
                                </div>
                                <div class="w-full xl:w-1/2">
                                    <?php inputv1('Quantity', 'quantity', 'number', 'Quantity', true, ''); ?>
                                </div>
                            </div>
                            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                <div class="w-full xl:w-1/2">
                                    <?php inputv1('Price', 'price', 'number', 'Price', true, ''); ?>
                                </div>

                                <div class="w-full xl:w-1/2">

                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" data-repeater-create class="text-xs text-white bg-primary px-2 py-1 inline-block">Add Item</a>
                </div>

                <hr class="hr1">

                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Shipping Cost', 'shipping_cost', 'number', 'Shipping Cost', true, ''); ?>
                    </div>

                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Vat / GST (%)', 'vat', 'number', 'Vat / GST (%)', true, ''); ?>
                    </div>
                </div>

                <hr class="hr1">

                <div class="mb-4.5">
                    <label class="block text-sm font-medium text-black dark:text-white">Quotation Footer Text</label>
                    <?php
                    $content = '';
                    $editor_id = 'quotation_text';
                    $settings = array(
                        'wpautop' => true,
                        'media_buttons' => false,
                        'textarea_name' => $editor_id,
                        'textarea_rows' => '8',
                        'tabindex' => '',
                        'editor_css' => '',
                        'editor_class' => '',
                        'teeny' => false,
                        'dfw' => false,
                        'tinymce' => true,
                        'quicktags' => true
                    );
                    wp_editor(html_entity_decode(stripcslashes($content)), $editor_id, $settings); ?>
                </div>

            <?php
            elseif ($account):
                $current_user_id = get_current_user_id();
                $user_info = get_userdata($current_user_id);
                $first_name = $user_info->first_name;
                $last_name = $user_info->last_name;
            ?>
                <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                    <div class="w-full xl:w-1/2">
                        <?php inputv1('First Name', 'first_name', 'text', 'First Name', true, '', $first_name); ?>
                    </div>

                    <div class="w-full xl:w-1/2">
                        <?php inputv1('Last Name', 'last_name', 'text', 'Last Name', true, '', $last_name); ?>
                    </div>
                </div>
            <?php else: ?>
                <?php if ($sell_new): ?>
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <?php selectv1('Select Product', 'product_item', 'Select Product', true, '', query_items('inventory-products'), 'v1') ?>
                        </div>

                        <div class="w-full xl:w-1/2">
                            <?php inputv1('Quantity', 'quantity', 'number', 'Quantity', true, ''); ?>
                        </div>
                    </div>
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <?php inputv1('Total Price in Tk', 'price_taka', 'number', 'Total Price in Tk', true, ''); ?>
                        </div>

                        <div class="w-full xl:w-1/2"></div>
                    </div>
                <?php endif; ?>

                <?php if (!$sell_new): ?>
                    <input type="hidden" name="cost_type" value="<?php echo esc_attr($cost_type); ?>">
                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <?php inputv1('Name of company', 'company_name', 'text', 'Name of company', true, ''); ?>
                        </div>

                        <div class="w-full xl:w-1/2">
                            <?php inputv1('Name of Items', 'items_name', 'text', 'Name of Items', true, ''); ?>
                        </div>
                    </div>

                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <?php inputv1('Quantity', 'quantity', 'number', 'Quantity', true, ''); ?>
                        </div>

                        <div class="w-full xl:w-1/2">
                            <?php inputv1(('Cost in ' . $cost_text), 'rmb_cost', 'number', ('Cost in ' . $cost_text), true, ''); ?>
                        </div>
                    </div>

                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2">
                            <?php inputv1('CNF Cost', 'cnf_cost', 'number', 'CNF Cost', true, ''); ?>
                        </div>
                        <div class="w-full xl:w-1/2">
                            <?php inputv1('Total Price in Tk', 'price_taka', 'number', 'Total Price in Tk', true, ''); ?>
                        </div>
                    </div>

                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                        <div class="w-full xl:w-1/2 ">
                            <p class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Upload Product Image
                            </p>
                            <label class="w-full block border border-solid p-3">
                                <input type="file" name="product_images[]" multiple accept="image/*, application/pdf">
                            </label>
                        </div>

                        <div class="w-full xl:w-1/2"></div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <button type="submit" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90">
                <?php if ($sell_new): ?>
                    Add Sell
                <?php elseif ($quotation_new): ?>
                    Add Quotation
                <?php else: ?>
                    Add Product
                <?php endif; ?>
            </button>
        </div>
    </form>
</div>
<?php
$template = ob_get_clean();
$button = '<div class="loader_render"></div>';
get_template_part('template-parts/common/common', null, ['template' => $template, 'button' => $button]);
