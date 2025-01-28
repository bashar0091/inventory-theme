<?php
$menu_item = get_query_var('menu_item');
if (!empty($menu_item)) {
    $slug = $menu_item['slug'];
    $title = $menu_item['title'];
    $icon = $menu_item['icon'];
    $submenu = $menu_item['submenu'];
    $class = $menu_item['class'];
    $active = '';

    if (is_page($slug)) {
        $active = 'bg-graydark';
    }

    if (parent_page($slug)) {
        $active = 'bg-graydark';
    }
?>
    <li>
        <a
            class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4 <?php echo esc_attr($class); ?> <?php echo esc_attr($active); ?>"
            href="<?php echo esc_url(empty($submenu) ? home_url('/' . $slug) : '#!'); ?>">
            <?php
            if (!empty($icon)) {
                echo $icon;
            }
            ?>

            <?php echo wp_kses_post($title); ?>

            <?php
            if (!empty($submenu)) {
            ?>
                <svg
                    class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                    width="20"
                    height="20"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                        fill="" />
                </svg>
            <?php
            }
            ?>
        </a>


        <?php
        if (!empty($submenu)) {
        ?>
            <div
                class="translate transform overflow-hidden">
                <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                    <?php
                    foreach ($submenu as $item) {
                        $submenutitle = $item['title'];
                        $submenuslug = $item['slug'];
                        $subactive = is_page($submenuslug) ? 'text-white' : '';
                    ?>
                        <li>
                            <a
                                class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white <?php echo esc_attr($subactive); ?>"
                                href="<?php echo esc_url(home_url('/' . $submenuslug)); ?>"><?php echo wp_kses_post($submenutitle); ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        <?php
        }
        ?>
    </li>
<?php
}
?>