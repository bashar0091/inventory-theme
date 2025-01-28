<?php
// Prevent direct access to the plugin file
defined('ABSPATH') || exit;

$template = $args['template'] ?? '';
$button = $args['button'] ?? '';
?>

<div
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">

        <!-- ===== Sidebar Start ===== -->
        <?php get_template_part('template-parts/sidebar/main'); ?>
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div
            class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- ===== Header Start ===== -->
            <?php get_template_part('template-parts/dashboard-header/main'); ?>
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <div id="top_breadcrumb"></div>
                    <div class="flex items-center justify-between rounded-md border border-stroke bg-white p-4 py-3 dark:border-strokedark dark:bg-meta-4 sm:px-6 sm:py-5.5 xl:px-7.5 mb-5">
                        <nav>
                            <ol class="flex flex-wrap items-center gap-3">
                                <li>
                                    <a class="flex items-center gap-3.5 font-medium text-black hover:text-primary dark:text-white dark:hover:text-primary" href="<?php echo esc_url(home_url()); ?>">
                                        Home
                                    </a>
                                </li>
                                <li class="flex items-center gap-3 font-medium">
                                    <svg class="fill-current" width="6" height="15" viewBox="0 0 6 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.80682 0.818303L2.05682 14.7501H0.255682L4.00568 0.818303H5.80682Z" fill=""></path>
                                    </svg>
                                    <?php echo wp_kses_post(get_the_title()); ?>
                                </li>
                            </ol>
                        </nav>

                        <?php echo $button; ?>
                    </div>

                    <?php echo $template; ?>
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
</div>