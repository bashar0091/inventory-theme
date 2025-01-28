<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

get_header();

ob_start();

$billing_from = get_field('billing_from');
$billing_email = get_field('billing_email');
$billing_phone = get_field('billing_phone');

$billing_to = get_field('billing_to');
$to_email = get_field('to_email');
$to_phone = get_field('to_phone');

$invoice_id = get_field('invoice_id');
$date_issued = get_field('date_issued');
$due_date = get_field('due_date');
$due_amount = get_field('due_amount');
?>
<div class="mb-10 rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
    <div class="p-4 sm:p-6 xl:p-9">
        <div class="mb-10 flex flex-wrap items-center justify-end gap-3.5">
            <button data-pdfname="Quotation-for-<?php echo wp_kses_post($billing_to); ?>" data-layout="A4" class="inventory_pdf_export inline-flex items-center gap-2.5 rounded bg-primary px-4 py-[7px] font-medium text-white hover:bg-opacity-90">
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.3566 4.07803V1.96865C15.3566 1.15303 14.6816 0.478027 13.866 0.478027H4.10664C3.29102 0.478027 2.61602 1.15303 2.61602 1.96865V4.07803C1.82852 4.10615 1.18164 4.75303 1.18164 5.54053V9.59053C1.18164 10.378 1.82852 11.0249 2.61602 11.053V16.0312C2.61602 16.8468 3.29102 17.5218 4.10664 17.5218H13.8941C14.7098 17.5218 15.3848 16.8468 15.3848 16.0312V11.053C16.1723 11.0249 16.8191 10.378 16.8191 9.59053V5.54053C16.791 4.75303 16.1441 4.10615 15.3566 4.07803ZM3.90977 1.96865C3.90977 1.85615 3.99414 1.74365 4.13477 1.74365H13.9223C14.0348 1.74365 14.1473 1.82803 14.1473 1.96865V4.07803H3.90977V1.96865ZM14.091 16.0312C14.091 16.1437 14.0066 16.2562 13.866 16.2562H4.10664C3.99414 16.2562 3.88164 16.1718 3.88164 16.0312V11.053H14.091V16.0312V16.0312ZM15.5254 9.59053C15.5254 9.70303 15.441 9.81553 15.3004 9.81553H2.67227C2.55977 9.81553 2.44727 9.73115 2.44727 9.59053V5.54053C2.44727 5.42803 2.53164 5.31553 2.67227 5.31553H15.3004C15.4129 5.31553 15.5254 5.3999 15.5254 5.54053V9.59053V9.59053Z" fill=""></path>
                    <path d="M6.89102 13.2186H11.1098C11.4473 13.2186 11.7566 12.9373 11.7566 12.5717C11.7566 12.2061 11.4754 11.9248 11.1098 11.9248H6.89102C6.55352 11.9248 6.24414 12.2061 6.24414 12.5717C6.24414 12.9373 6.55352 13.2186 6.89102 13.2186Z" fill=""></path>
                    <path d="M14.0629 6.5249H11.9535C11.616 6.5249 11.3066 6.80615 11.3066 7.17178C11.3066 7.5374 11.5879 7.81865 11.9535 7.81865H14.0629C14.4004 7.81865 14.7098 7.5374 14.7098 7.17178C14.7098 6.80615 14.4285 6.5249 14.0629 6.5249Z" fill=""></path>
                    <path d="M6.89102 15.3562H11.1098C11.4473 15.3562 11.7566 15.075 11.7566 14.7094C11.7566 14.3437 11.4754 14.0625 11.1098 14.0625H6.89102C6.55352 14.0625 6.24414 14.3437 6.24414 14.7094C6.24414 15.075 6.55352 15.3562 6.89102 15.3562Z" fill=""></path>
                </svg>
                Print PDF
            </button>
        </div>

        <div class="inventory_pdf_body">
            <div class="flex flex-wrap justify-between gap-5">
                <div>
                    <p class="mb-1.5 font-medium text-black dark:text-white">
                        Billing From:
                    </p>
                    <h4 class="mb-3 text-xl font-bold text-black dark:text-white">
                        <?php echo wp_kses_post($billing_from); ?>
                    </h4>
                    <a href="#" class="block"><span class="font-medium text-black dark:text-white">Email:</span>
                        <?php echo wp_kses_post($billing_email); ?></a>
                    <span class="mt-1.5 block"><span class="font-medium text-black dark:text-white">Phone:</span>
                        <?php echo wp_kses_post($billing_phone); ?></span>
                </div>

                <div>
                    <p class="mb-1.5 font-medium text-black dark:text-white">
                        Billing To:
                    </p>
                    <h4 class="mb-3 text-xl font-bold text-black dark:text-white">
                        <?php echo wp_kses_post($billing_to); ?>
                    </h4>
                    <a href="#" class="block"><span class="font-medium text-black dark:text-white">Email:</span>
                        <?php echo wp_kses_post($to_email); ?></a>
                    <span class="mt-1.5 block"><span class="font-medium text-black dark:text-white">Phone:</span>
                        <?php echo wp_kses_post($to_phone); ?></span></span>
                </div>
            </div>

            <div class="my-7.5 grid grid-cols-1 border border-stroke dark:border-strokedark xsm:grid-cols-2 sm:grid-cols-4">
                <div class="border-b border-r border-stroke px-5 py-4 last:border-r-0 dark:border-strokedark sm:border-b-0">
                    <h5 class="mb-1.5 font-bold text-black dark:text-white">
                        Invoice ID :
                    </h5>
                    <span class="text-sm font-medium"> <?php echo wp_kses_post($invoice_id); ?> </span>
                </div>

                <div class="border-b border-stroke px-5 py-4 last:border-r-0 dark:border-strokedark sm:border-b-0 sm:border-r">
                    <h5 class="mb-1.5 font-bold text-black dark:text-white">
                        Date Issued :
                    </h5>
                    <span class="text-sm font-medium"> <?php echo wp_kses_post($date_issued); ?> </span>
                </div>

                <div class="border-b border-r border-stroke px-5 py-4 last:border-r-0 dark:border-strokedark xsm:border-b-0">
                    <h5 class="mb-1.5 font-bold text-black dark:text-white">
                        Due Date :
                    </h5>
                    <span class="text-sm font-medium"> <?php echo wp_kses_post($due_date); ?> </span>
                </div>

                <div class="border-r border-stroke px-5 py-4 last:border-r-0 dark:border-strokedark">
                    <h5 class="mb-1.5 font-bold text-black dark:text-white">
                        Due Amount :
                    </h5>
                    <span class="text-sm font-medium"> <?php echo wp_kses_post($due_amount); ?> </span>
                </div>
            </div>

            <div class="border border-stroke dark:border-strokedark">
                <div class="max-w-full overflow-x-auto">
                    <div class="min-w-[670px]">
                        <!-- table header start -->
                        <div class="grid grid-cols-12 border-b border-stroke py-3.5 pl-5 pr-6 dark:border-strokedark">
                            <div class="col-span-3">
                                <h5 class="font-medium text-black dark:text-white">
                                    Brand name
                                </h5>
                            </div>

                            <div class="col-span-4">
                                <h5 class="font-medium text-black dark:text-white">
                                    Description
                                </h5>
                            </div>

                            <div class="col-span-2">
                                <h5 class="font-medium text-black dark:text-white">
                                    Quantity
                                </h5>
                            </div>

                            <div class="col-span-2">
                                <h5 class="font-medium text-black dark:text-white">
                                    Price Per Unit
                                </h5>
                            </div>

                            <div class="col-span-1">
                                <h5 class="text-right font-medium text-black dark:text-white">
                                    Total
                                </h5>
                            </div>
                        </div>
                        <!-- table header end -->

                        <!-- product item -->
                        <div class="grid grid-cols-12 border-b border-stroke py-3.5 pl-5 pr-6 dark:border-strokedark">
                            <div class="col-span-3">
                                <p class="font-medium">Techno</p>
                            </div>

                            <div class="col-span-4">
                                <p class="font-medium">Kemon 24 smart phone</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-medium">1</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-medium">$200</p>
                            </div>

                            <div class="col-span-1">
                                <p class="text-right font-medium">$200</p>
                            </div>
                        </div>

                        <!-- product item -->
                        <div class="grid grid-cols-12 border-b border-stroke py-3.5 pl-5 pr-6 dark:border-strokedark">
                            <div class="col-span-3">
                                <p class="font-medium">Vivo</p>
                            </div>

                            <div class="col-span-4">
                                <p class="font-medium">Vivo 32 smart phone</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-medium">3</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-medium">$300</p>
                            </div>

                            <div class="col-span-1">
                                <p class="text-right font-medium">$900</p>
                            </div>
                        </div>

                        <!-- product item -->
                        <div class="grid grid-cols-12 border-b border-stroke py-3.5 pl-5 pr-6 dark:border-strokedark">
                            <div class="col-span-3">
                                <p class="font-medium">Samsung</p>
                            </div>

                            <div class="col-span-4">
                                <p class="font-medium">S23 Ultra</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-medium">1</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-medium">$1300</p>
                            </div>

                            <div class="col-span-1">
                                <p class="text-right font-medium">$1300</p>
                            </div>
                        </div>

                        <!-- product item -->
                        <div class="grid grid-cols-12 border-b border-stroke py-3.5 pl-5 pr-6 dark:border-strokedark">
                            <div class="col-span-3">
                                <p class="font-medium">Apple</p>
                            </div>

                            <div class="col-span-4">
                                <p class="font-medium">iPhone 15Pro Max</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-medium">2</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-medium">$1200</p>
                            </div>

                            <div class="col-span-1">
                                <p class="text-right font-medium">$2400</p>
                            </div>
                        </div>

                        <!-- product item -->
                        <div class="grid grid-cols-12 border-b border-stroke py-3.5 pl-5 pr-6 dark:border-strokedark">
                            <div class="col-span-3">
                                <p class="font-medium">Oppo</p>
                            </div>

                            <div class="col-span-4">
                                <p class="font-medium">Fold X</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-medium">1</p>
                            </div>

                            <div class="col-span-2">
                                <p class="font-medium">$900</p>
                            </div>

                            <div class="col-span-1">
                                <p class="text-right font-medium">$900</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- total price start -->
                <div class="flex justify-end p-6">
                    <div class="w-full max-w-65">
                        <div class="flex flex-col gap-4">
                            <p class="flex justify-between font-medium text-black dark:text-white">
                                <span> Subtotal </span>
                                <span> $4700 </span>
                            </p>

                            <p class="flex justify-between font-medium text-black dark:text-white">
                                <span> Shipping Cost (+) </span>
                                <span> $10.00 </span>
                            </p>

                            <p class="flex justify-between font-medium text-black dark:text-white">
                                <span> Vat <span class="text-red">(5%)</span> </span>
                                <span> $235 </span>
                            </p>
                        </div>

                        <p class="mt-4 flex justify-between border-t border-stroke pt-5 dark:border-strokedark">
                            <span class="font-medium text-black dark:text-white">
                                Total
                            </span>
                            <span class="font-bold text-meta-3"> $4475 </span>
                        </p>
                    </div>
                </div>
                <!-- total price end -->
            </div>
        </div>
    </div>
</div>
<?php
$template = ob_get_clean();

get_template_part('template-parts/common/common', null, ['template' => $template]);

get_footer();
